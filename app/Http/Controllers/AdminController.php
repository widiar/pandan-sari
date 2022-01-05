<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Mail\LaporanBookingMail;
use App\Mail\PaymentRejectMail;
use App\Mail\ReplyContactMail;
use App\Models\Cart;
use App\Models\GetInTouch;
use App\Models\Invoice;
use App\Models\LaporanTransaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->username)->first();
        if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
            if ($user && $user->role == 1)
                return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->with('status', 'Username atau Password anda salah')->withInput();
    }

    public function booking()
    {
        $data = Invoice::with(['user', 'cart'])->orderBy('created_at', 'desc')->get();
        return view('admin.booking.index', compact('data'));
    }

    public function verifBooking(Request $request)
    {
        try {
            $inv = Invoice::find($request->id);
            $inv->load('user', 'cart');
            Mail::to($inv->user->email)->send(new InvoiceMail($inv));
            Mail::to(env('MAIL_CONTACT'))->send(new LaporanBookingMail($inv));
            $inv->status = 'payment-verifed';
            $inv->save();
            $inv->cart()->update(['status' => 'payment-verifed']);
            return response()->json('Success');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function rejectBooking(Request $request)
    {
        try {
            $inv = Invoice::find($request->id);
            $inv->status = 'payment-rejected';
            $inv->load('user');
            Mail::to($inv->user->email)->send(new PaymentRejectMail($inv->nomor));
            $inv->save();
            return response()->json('Success');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function rejectAlasanBooking(Request $request)
    {
        try {
            $inv = Invoice::find($request->id);
            $inv->alasan = $request->alasan;
            $inv->save();
            return response()->json([
                'status' => 'Success',
                'id' => $request->id
            ]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function destroyBooking($id)
    {
        $data = Invoice::find($id);
        Storage::disk('public')->delete('bukti-bayar/' . $data->bukti_bayar);
        Cart::where('invoice_id', $id)->delete();
        $data->delete();
        return response()->json('Sukses');
    }

    public function transaksi()
    {
        $data = LaporanTransaksi::all();
        return view('admin.transaksi.index', compact('data'));
    }

    // public function transaksiPrint()
    // {
    //     $invoice = Invoice::where('status', 'payment-verifed')->get();
    //     $invoice->load('user', 'cart');
    //     $pdf = PDF::loadView('admin.transaksi.pdf', compact('invoice'));
    //     $pdf->setOption('header-html', view('admin.headerPdf'));
    //     return $pdf->download('Laporan Transaksi ' . uniqid() . '.pdf');
    // }

    public function transaksiPost(Request $request)
    {
        try {
            $tmp = explode("-", $request->tanggal);
            $bulan = $tmp[0];
            $tahun = $tmp[1];
            $cek = LaporanTransaksi::where([
                ['bulan', $bulan],
                ['tahun', $tahun]
            ])->first();
            if ($cek) return response()->json('Ada');

            $filename = uniqid() . ".pdf";
            $invoice = Invoice::where('status', 'payment-verifed')->whereMonth('updated_at', $bulan)->whereYear('updated_at', $tahun)->get();
            $invoice->load('user', 'cart');
            $pdf = PDF::loadView('admin.transaksi.pdf', compact('invoice'));
            $pdf->setOption('header-html', view('admin.headerPdf'))->save('storage/laporan-transaksi/' . $filename);

            LaporanTransaksi::create([
                'file' => $filename,
                'bulan' => $bulan,
                'tahun' => $tahun
            ]);

            return response()->json('Success');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function transaksiDelete($id)
    {
        $data = LaporanTransaksi::find($id);
        Storage::disk('public')->delete('laporan-transaksi/' . $data->file);
        $data->delete();
        return response()->json('Sukses');
    }

    public function contactus()
    {
        $data = GetInTouch::all();
        return view('admin.getintouch.index', compact('data'));
    }

    public function replyPesan(Request $request)
    {
        try {
            $contact = GetInTouch::find($request->idContact);
            $pesan = $request->pesan;
            $data = [
                'nama' => $contact->nama,
                'pesan' => $contact->pesan,
                'pesanBalasan' => $pesan,
                'subject' => $contact->subject
            ];
            Mail::to($contact->email)->send(new ReplyContactMail($data));
            $contact->is_reply = 1;
            $contact->save();
            return response()->json('Success');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function dev()
    {
        $markdown = new Markdown(view(), config('mail.markdown'));
        $url = '#';
        $invoice = Invoice::find(1);
        $invoice->load('user');
        return $markdown->render('email.laporanBooking', compact('invoice'));
        // $inv = Invoice::find(1);
        // $inv->load('user', 'cart');
        // dd($inv);
    }
}
