<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Str;

class CustomerController extends Controller
{

    public function index()
    {
        if (!hasPermission('customer', 'read')) {
            return redirect()->back()
                ->with('error', 'Anda tidak memiliki izin.');
        }

        $customer = Customer::all();
        return view('admin.customer', [
            'title' => 'Customer',
            'active' => 'Customer',
            'customer' => $customer,
            'user' => auth()->user(),
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        if (!hasPermission('customer', 'delete')) {
            return redirect()->back()
                ->with('error', 'Anda tidak memiliki izin.');
        }

        $customer = Customer::findOrFail($id);

        $customer->delete();

        return redirect()->back()->with('success', 'Customer berhasil dihapus.');
    }
}
