<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $toko = Toko::all();
        $user = User::all();
        return view('toko.index', compact('toko','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validasi = Validator::make($input,[
            'nama_toko' => 'required|min:5|max:128|string',
            'kategori_toko' => 'required',
            'desc_toko' => 'required',
            'hari_buka' => 'required',
            'jam_buka' => 'required',
            'jam_libur' => 'required',
            'icon_toko' => 'required',
        ]);
        if($validasi->fails())
        {
            return back()->withErrors($validasi)->withInput();
        }

        if($request->hasFile('icon_toko'))
        {
            $folder = "public/image/toko"; // Membuat Folder Penyimpanan
            $gambar = $request->file('icon_toko'); // Mengambil Data Dari Request File
            $nama_gambar = $gambar->getClientOriginalName(); // Mengambil Nama File
            $path = $request->file('icon_toko')->storeAs($folder, $nama_gambar); // Menyimpan File
            $input['icon_toko'] = $nama_gambar; // Memberi Nama Yang Dikirim Ke Database
        }

        // Konversi Nilai
        $hari = implode(',',$request->input('hari_buka'));
        $input['hari_buka'] = $hari;
        
        Toko::create($input);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Toko::find($id);
        return view('toko.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Toko $toko)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_toko' => '',
            'kategori_toko' => '',
            'desc_toko' => '',
            'icon_toko' => '',
            'jam_buka' => '',
            'jam_libur' => '',
            'aktif' => '',
            'hari_buka' => '',
        ]);

        $toko = Toko::findOrFail($id);
        $toko->nama_toko = $request->nama_toko;
        $toko->kategori_toko = $request->kategori_toko;
        $toko->desc_toko = $request->desc_toko;
        $toko->jam_buka = $request->jam_buka;
        $toko->jam_libur = $request->jam_libur;
        $toko->aktif = $request->aktif;
        $toko->hari_buka = implode(',', $request->hari_buka); // Menyimpan hari_buka sebagai string

        if ($request->hasFile('icon_toko')) {
            // Hapus gambar lama jika ada
            if ($toko->icon_toko) {
                Storage::delete('public/image/toko/' . $toko->icon_toko);
            }
            // Simpan gambar baru
            $imagePath = $request->file('icon_toko')->store('public/image/toko');
            $toko->icon_toko = basename($imagePath);
        }

        $toko->save();

        return redirect()->route('toko.index', $toko->id)->with('success', 'Toko updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Toko $toko)
    {
        //
    }
}
