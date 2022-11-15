<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class JuriController extends Controller
{
    public function index()
    {
        $juri = User::role('juri')->get();
        return response()->json($juri);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole('juri');

        return response()->json([
            'message' => 'Juri berhasil ditambahkan',
            'data' => $user
        ], 201);
    }

    public function show($id)
    {
        $request = User::find($id);
        return response()->json([
            'message' => 'Detail data juri',
            'data' => $request
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'message' => 'Juri berhasil diupdate',
            'data' => $user
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'message' => 'Juri berhasil dihapus',
            'data' => $user
        ], 200);
    }
}
