<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Superadmin
{
    //
    public function index()
    {
        $superadmin = User::whereIn('role', ['admin', 'staff'])->get();
        return view('dashboard.profile.user', compact('superadmin'));
    }
    public function staff(){
        return view('dashboard.staff');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.profile.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:superadmin,admin,staff',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'username' => 'required|string'
        ]);

        // Jika ada upload foto profil
        if ($request->hasFile('profile_photo')) {
            $filename = time() . '.' . $request->profile_photo->extension();
            $request->profile_photo->move(public_path('storage/profile'), $filename);
            $validated['profile_photo'] = $filename;
        }

        $user->update($validated);

        return redirect()->route('superadmin')->with('success', 'User berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('superadmin')->with('success', 'User berhasil dihapus.');
    }
}
