<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Auth;

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
        $data = Invoice::all();
        return view('admin.booking.index', compact('data'));
    }

    public function verifBooking(Request $request)
    {
        try {
            $inv = Invoice::find($request->id);
            $inv->status = 'payment-verifed';
            $inv->save();
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
            $inv->save();
            return response()->json('Success');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function dev()
    {
        $markdown = new Markdown(view(), config('mail.markdown'));
        $url = '#';
        return $markdown->render('email.coba', compact('url'));
    }
}
