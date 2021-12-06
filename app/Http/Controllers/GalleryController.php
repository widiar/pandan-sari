<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Gallery::all();
        return view('admin.gallery.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'foto' => 'required|image',
            'status' => 'required|in:draft,publish'
        ]);
        $foto = $request->foto;
        Gallery::create([
            'nama' => $request->nama,
            'file' => $foto->hashName(),
            'status' => $request->status,
        ]);
        $foto->storeAs('public/gallery', $foto->hashName());
        return redirect()->route('admin.gallery.index')->with('success', 'Berhasil menambah data');
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
        $data = Gallery::find($id);
        return view('admin.gallery.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Gallery::find($id);
        $data->nama = $request->nama;
        $data->status = $request->status;
        $foto = $request->file('foto');
        if ($foto) {
            Storage::disk('public')->delete('gallery/' . $data->image);
            $foto->storeAs('public/gallery', $foto->hashName());
            $data->file = $foto->hashName();
        }
        $data->save();
        return redirect()->route('admin.gallery.index')->with('success', 'Berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Gallery::find($id);
        Storage::disk('public')->delete('gallery/' . $data->file);
        $data->delete();
        return response()->json("Sukses");
    }
}
