<?php

namespace App\Http\Controllers;

use App\Models\WaterSport;
use Illuminate\Http\Request;

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
}
