<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Profiler\Profile;

class AdminController extends Controller
{
    public function admin()
    {
        $users = User::where('role', 'admin')->get();
        return view('admin.manajemenAdmin', compact('users'));
    }

    public function ahli()
    {
        $users = User::where('role', 'ahli')->get();
        return view('admin.manajemenAhli', compact('users'));
    }

    public function petani()
    {
        $users = User::where('role', 'petani')->get();
        return view('admin.manajemenPetani', compact('users'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role, // role bisa 'admin', 'petani', atau 'ahli'
            ]);

            return redirect()->back()->with('success', 'Admin created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat admin: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return redirect()->back()->with('success', 'Admin updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui admin: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'data telah dihapus');
    }
}
