<?php

namespace App\Http\Controllers;

use App\Http\Requests\WaterSportRequest;
use App\Models\WaterSport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WaterSportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = WaterSport::all();
        return view('admin.watersport.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.watersport.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WaterSportRequest $request)
    {
        $foto = $request->foto;
        WaterSport::create([
            'nama' => $request->nama,
            'image' => $foto->hashName(),
            'deskripsi' => $request->description,
            'harga' => $request->harga,
            'minimal' => $request->minimal
        ]);
        $foto->storeAs('public/water-sport', $foto->hashName());
        return redirect()->route('admin.water-sport.index')->with('success', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = WaterSport::find($id);
        return view('admin.watersport.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WaterSportRequest $request, $id)
    {
        $data = WaterSport::find($id);
        $data->nama = $request->nama;
        $data->deskripsi = $request->description;
        $data->harga = $request->harga;
        $data->minimal = $request->minimal;
        $foto = $request->file('foto');
        if ($foto) {
            Storage::disk('public')->delete('water-sport/' . $data->image);
            $foto->storeAs('public/water-sport', $foto->hashName());
            $data->image = $foto->hashName();
        }
        $data->save();
        return redirect()->route('admin.water-sport.index')->with('success', 'Berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = WaterSport::find($id);
        Storage::disk('public')->delete('water-sport/' . $data->image);
        $data->delete();
        return response()->json("Sukses");
    }
}
