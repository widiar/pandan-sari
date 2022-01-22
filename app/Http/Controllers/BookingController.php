<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Mail\LaporanBookingMail;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\User;
use App\Models\WaterSport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Xendit\Xendit;
use Xendit\Invoice as XenInv;

class BookingController extends Controller
{
    public function booking()
    {
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            $user->load(['cart' => function ($q) {
                $q->where('status', 'unpaid')->orderBy('tanggal');
            }]);
            $carts = $user->cart;
            foreach ($carts as $cart) {
                $cart->total = $cart->jumlah * $cart->satuan;
                $cart->save();
            }
            $carts->load('watersport');
            return view('booking', compact('carts', 'user'));
        } else {
            return view('booking');
        }
    }

    public function add(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        try {
            $cart = Cart::firstOrCreate([
                'user_id' => $user->id,
                'watersport_id' => $request->watersport,
                'tanggal' => NULL,
                'status' => 'unpaid'
            ]);
            $cart->jumlah = $request->orang;
            $cart->total = $request->orang * $request->satuan;
            $cart->satuan = $request->satuan;
            // if ($cart->jumlah) {
            //     $cart->jumlah = $cart->jumlah + $request->orang;
            //     $cart->total = $cart->total + $request->total;
            //     $cart->satuan = $request->satuan;
            // } else {
            //     // $booking = $request->session()->get('booking');
            //     // $booking += 1;
            //     // $request->session()->put('booking', $booking);
            // }
            $cart->save();
            // return response()->json('Success');
            return response()->json([
                'cart' => $cart,
                'total' => $request->orang * $request->satuan
            ]);
        } catch (\Throwable $th) {
            return response()->json($th, 400);
        }
    }

    public function change(Request $request)
    {
        $id = $request->id;
        $jumlah = $request->jumlah;
        $isInput = $request->isInput;
        $cart = Cart::find($id);
        $watersport = WaterSport::find($cart->watersport_id);
        if($isInput == 1) {
            $jml = $jumlah;
            $cart->jumlah = $jumlah;
        }else{
            $jml = $cart->jumlah + $jumlah;
            $cart->jumlah = $jml;
        }
        $cart->total = $watersport->harga * $jml;
        $cart->save();
        return response()->json([
            'total' => $watersport->harga * $jml,
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $cart = Cart::find($id);
        $cart->delete();
        $user = Auth::user();
        $booking = Cart::where('user_id', $user->id)->where('status', 'unpaid')->get()->count();
        // $request->session()->put('booking', $booking);
        return response()->json([
            'booking' => $booking
        ]);
    }

    public function deleteAll(Request $request)
    {
        $user = Auth::user();
        Cart::where('user_id', $user->id)->where('status', 'unpaid')->delete();
        $booking = Cart::where('user_id', $user->id)->where('status', 'unpaid')->get()->count();
        $request->session()->put('booking', $booking);
        return response()->json([
            'booking' => $booking
        ]);
    }

    public function identitas(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->nama = $request->nama;
        $user->alamat = $request->alamat;
        $user->no_tlp = $request->tlp;
        $user->save();
        $carts = Cart::with('watersport')->where([
            ['status', 'payment-verifed'],
            ['user_id', $user->id],
            ['tanggal', $request->tanggal]
        ])->get();
        $err = [];
        foreach ($carts as $cart) {
            $sisa = $cart->watersport->getSisa($request->tanggal);
            if (($sisa - $cart->jumlah) < 0) {
                array_push($err, $cart->watersport->nama);
            }
        }
        if (count($err) > 0) {
            return response()->json([
                'wisata' => $err,
                'tanggal' => $request->tanggal,
                'status' => 'tanggal'
            ]);
        }
        Cart::with('watersport')->where([
            ['status', 'unpaid'],
            ['user_id', $user->id],
            ['tanggal', NULL]
        ])->update(['tanggal' => $request->tanggal, 'jam' => $request->jam]);

        $inv = uniqid('INV/');
        $invoice = Invoice::create([
            'user_id' => $user->id,
            'nomor' => strtoupper($inv),
            'bukti_bayar' => 'xendit',
            'total' => $request->totalInv,
            'status' => 'payment-unverifed'
        ]);
        //update cart
        Cart::where('user_id', $user->id)->where('status', 'unpaid')->update(['status' => 'payment-unverifed', 'invoice_id' => $invoice->id]);

        Xendit::setApiKey(env('XENDIT_SECRET_KEY'));
        $params = [
            'external_id' => $inv,
            'amount' => $invoice->total,
            'customer' => [
                'given_names' => $user->nama,
                'email' => $user->email
            ],
            'payer_email' => $user->email,
            'success_redirect_url' => route('home', ['callback' => Crypt::encryptString($invoice->id)]),
            'currency' => 'IDR'
        ];
        $xenInv = XenInv::create($params);
        
        return response()->json([
            'status' => 'Success',
            'invoice' => $xenInv,
        ]);
    }

    public function xenditInvoiceCallback(Request $request)
    {
        $callbackToken = $request->header('x-callback-token');
        if($callbackToken == env('XENDIT_CALLBACK_TOKEN')){
            $responseArray = $request->json()->all();
            $inv = Invoice::where('nomor', $responseArray['external_id'])
                ->with(['user', 'cart'])
                ->first();
            if($inv){
                Mail::to($inv->user->email)->send(new InvoiceMail($inv));
                Mail::to(env('MAIL_CONTACT'))->send(new LaporanBookingMail($inv));
                $inv->status = 'payment-verifed';
                $inv->save();
                $inv->cart()->update(['status' => 'payment-verifed']);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Sucess',
                    'data' => $inv
                ]);            
            }else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Invoice Not Found',
                ]);            
            }
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Wrong callback token'
            ]);
        }
    }


    public function invoice(Request $request)
    {
        $tgl = date('d/m/Y');
        $user = User::find(Auth::user()->id);
        $inv = uniqid('INV/');
        $bukti = $request->bukti;
        $invoice = Invoice::create([
            'user_id' => $user->id,
            'nomor' => strtoupper($inv),
            'bukti_bayar' => $bukti->hashName(),
            'total' => $request->totalInv,
            'status' => 'payment-unverifed'
        ]);
        $bukti->storeAs('public/bukti-bayar', $bukti->hashName());
        //update cart
        Cart::where('user_id', $user->id)->where('status', 'unpaid')->update(['status' => 'payment-unverifed', 'invoice_id' => $invoice->id]);
        //update sesion
        $booking = Cart::where('user_id', $user->id)->where('status', 'unpaid')->get()->count();
        $request->session()->put('booking', $booking);
        return response()->json('Success');
    }

    public function detailInvoice(Request $request)
    {
        $id = $request->id;
        $invoice = Invoice::find($id);
        $invoice->load('cart');
        $cart = $invoice->cart;
        $cart->load('watersport');
        $user = $invoice->user;
        return response()->json([
            'data' => $cart,
            'user' => $user,
            'total' => $invoice->total
        ]);
    }

    public function uploadUlang(Request $request)
    {
        try {
            $inv = Invoice::where('nomor', $request->inv)->firstOrFail();
            $bukti = $request->bukti;
            $inv->bukti_bayar = $bukti->hashName();
            $inv->status = 'payment-unverifed';
            $bukti->storeAs('public/bukti-bayar', $bukti->hashName());
            $inv->save();
            return response()->json('Success');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
