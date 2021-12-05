<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\WaterSport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function contact()
    {
        return view('public.contact');
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
}
