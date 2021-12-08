<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Gallery;
use App\Models\Invoice;
use App\Models\User;
use App\Models\WaterSport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $watersport = WaterSport::all();
        return view('home', compact('watersport'));
    }

    public function home()
    {
        return view('home');
    }

    public function detail($id)
    {
        $data = WaterSport::findOrFail($id);
        return view('detail', compact('data'));
    }

    public function transaksi()
    {
        $user = Auth::user();
        $invoices = Invoice::where('user_id', $user->id)->get();
        return view('transaksi', compact('invoices'));
    }

    public function invoiceMail(Request $request)
    {
        $inv = Invoice::where('nomor', urldecode($request->nomor))->where('status', 'payment-verifed')->firstOrFail();
        $inv->load('user', 'cart');
        return view('email.invoice-detail', compact('inv'));
    }

    public function gallery()
    {
        $data = Gallery::where('status', 'publish')->get();
        return view('gallery', compact('data'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {
        try {
            Mail::to(env('MAIL_CONTACT'))->send(new ContactMail($request->all()));
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function akun()
    {
        $data = Auth::user();
        return view('profile', compact('data'));
    }

    public function updateAkun(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            $user->nama = $request->nama;
            $user->alamat = $request->alamat;
            $user->no_tlp = $request->no_tlp;
            $foto = $request->file('foto');
            if ($foto) {
                Storage::disk('public')->delete('profile/' . $user->image);
                $foto->storeAs('public/profile', $foto->hashName());
                $user->image = $foto->hashName();
            }
            $user->save();
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function about()
    {
        return view('about');
    }
}
