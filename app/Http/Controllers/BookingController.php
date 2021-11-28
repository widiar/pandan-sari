<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function booking()
    {
        return view('booking');
    }

    public function add(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        try {
            Cart::create([
                'user_id' => $user->id,
                'watersport_id' => $request->watersport,
                'tanggal' => $request->tanggal,
                'jumlah' => $request->orang,
                'total' => $request->total
            ]);
            $booking = $request->session()->get('booking');
            $booking += 1;
            $request->session()->put('booking', $booking);
            return response()->json('Success');
        } catch (\Throwable $th) {
            return response()->json($th, 400);
        }
    }
}
