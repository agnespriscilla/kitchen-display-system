<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WaitersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $waiters = User::where('role', 'waiters')->get();
        $bagian = Bagian::all();

        return view('admin.waiters.index', [
            'title'  => 'Waiters',
            'active' => 'Waiters',
            'waiters'   => $waiters,
            'bagian'   => $bagian,
            'user'   => auth()->user()
        ]);
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
        $request->validate([
            'bagian_id' => 'required|exists:bagian,id',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:3',
        ]);

        User::create([
            'bagian_id' => $request->bagian_id,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'waiters'
        ]);

        return redirect()->route('admin.waiters.index')
            ->with('success', 'waiters berhasil ditambahkan.');
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
        $waiter = User::where('id', $id)->first();
        $bagian = Bagian::all();

        return view('admin.waiters.edit', [
            'title'  => 'Waiters',
            'active' => 'Edit',
            'waiter'   => $waiter,
            'bagian'   => $bagian,
            'user'   => auth()->user()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'bagian_id' => 'required|exists:bagian,id',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:3',
        ]);

        $waiter = User::where('id', $id)->first();
        if (!empty($request->password)) {
            $waiter->update([
                'password' => Hash::make($request->password)
            ]);
        }
        $waiter->update([
            'bagian_id' => $request->bagian_id,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => 'waiters'
        ]);

        return redirect()->route('admin.waiters.index')
            ->with('success', 'waiters berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('admin.waiters.index')
            ->with('success', 'waiters berhasil dihapus.');
    }
}
