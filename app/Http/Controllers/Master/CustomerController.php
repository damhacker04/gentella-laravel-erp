<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('name')->get();
        return view('master.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('master.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:customers,code',
            'name' => 'required|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|max:20',
        ]);

        Customer::create($request->all());

        return redirect()->route('master.customers.index')
            ->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function show(Customer $customer)
    {
        $customer->load('salesOrders');
        return view('master.customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('master.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'code' => 'required|unique:customers,code,' . $customer->id,
            'name' => 'required|max:255',
            'email' => 'nullable|email',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $customer->update($data);

        return redirect()->route('master.customers.index')
            ->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return redirect()->route('master.customers.index')
                ->with('success', 'Pelanggan berhasil dihapus.');
        }
        catch (\Exception $e) {
            return redirect()->route('master.customers.index')
                ->with('error', 'Pelanggan tidak dapat dihapus karena masih memiliki transaksi.');
        }
    }
}
