<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view ('user.index', compact('users'));
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
        if($request->input('password'))
        {
            $input['password'] = $input['password'];
        }
        $validasi = Validator::make($input, [
            'name' => 'required|string|max:128',
            'level' => 'required',
            'email' => 'required|email|unique:users,email|max:50',
            'password' => 'required|min:8|max:30',
        ]);
        
        if($validasi->fails())
        {
            return back()->withErrors($validasi)->withInput();
        }

        User::create($input)->with('success','Data berhasil ditambahkan');
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
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $users = User::find($id);
        $users->update($data);
        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $users = Product::find($id);
        $data->delete();
        return back();
    }
}
