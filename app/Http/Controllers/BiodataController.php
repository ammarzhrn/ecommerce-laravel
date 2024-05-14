<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $data = $request->all();
        $validasi = Validator::make($data,[
            'no_hp' => 'required|max:15|min:10',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'pp' => 'required|mimes:png,jpg,jpeg,heic',
            'alamat' => 'required|max:255',
        ]);
        if($validasi->fails())
        {
            return back()->withErrors($validasi)->withInput();
        }

        if($request->hasFile('pp'))
        {
            $folder = "public/image"; // Membuat Folder Penyimpanan
            $gambar = $request->file('pp'); // Mengambil Data Dari Request File
            $nama_gambar = $gambar->getClientOriginalName(); // Mengambil Nama File
            $path = $request->file('pp')->storeAs($folder, $nama_gambar); // Menyimpan File
            $data['pp'] = $nama_gambar; // Memberi Nama Yang Dikirim Ke Database
        }

        Profile::create($data); 
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
