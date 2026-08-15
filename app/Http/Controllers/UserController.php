<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::with('school')
                ->orderBy('name')
                ->get(),

            'schools' => School::orderBy('official_name')
                ->get(['id', 'official_name']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:OPERATOR,ADMIN_CABDIN,SUPER_ADMIN',
            'school_id' => 'nullable|exists:schools,id|required_if:role,OPERATOR',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'school_id' => $validated['role'] === 'OPERATOR'
                ? $validated['school_id']
                : null,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Akun berhasil dibuat.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()
                ->back()
                ->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()
            ->back()
            ->with('success', 'Akun dihapus.');
    }
}