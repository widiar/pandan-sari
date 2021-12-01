<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\WaterSport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function booking()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->load(['cart' => function ($q) {
                $q->where('status', 'unpaid')->orderBy('tanggal');
            }]);
            $carts = $user->cart;
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
                'tanggal' => $request->tanggal,
            ]);
            if ($cart->jumlah) {
                $cart->jumlah = $cart->jumlah + $request->orang;
                $cart->total = $cart->total + $request->total;
            } else {
                $cart->jumlah = $request->orang;
                $cart->total = $request->total;
                $booking = $request->session()->get('booking');
                $booking += 1;
                $request->session()->put('booking', $booking);
            }
            $cart->save();
            return response()->json('Success');
        } catch (\Throwable $th) {
            return response()->json($th, 400);
        }
    }

    public function change(Request $request)
    {
        $id = $request->id;
        $jumlah = $request->jumlah;
        $cart = Cart::find($id);
        $watersport = WaterSport::find($cart->watersport_id);
        $jml = $cart->jumlah + $jumlah;
        $cart->jumlah = $jml;
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
        $request->session()->put('booking', $booking);
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
        return response()->json('Success');
    }
}
