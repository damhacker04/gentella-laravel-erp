<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::orderBy('name')->get();
        return view('master.warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        return view('master.warehouses.create');
    }

    public function store(Request $request)
    {
        $request->validate(['code' => 'required|unique:warehouses,code', 'name' => 'required|max:255']);
        Warehouse::create($request->all());
        return redirect()->route('master.warehouses.index')->with('success', 'Gudang berhasil ditambahkan.');
    }

    public function show(Warehouse $warehouse)
    {
        return view('master.warehouses.show', compact('warehouse'));
    }
    public function edit(Warehouse $warehouse)
    {
        return view('master.warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $request->validate(['code' => 'required|unique:warehouses,code,' . $warehouse->id, 'name' => 'required']);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $warehouse->update($data);
        return redirect()->route('master.warehouses.index')->with('success', 'Gudang berhasil diperbarui.');
    }

    public function destroy(Warehouse $warehouse)
    {
        try {
            $warehouse->delete();
            return redirect()->route('master.warehouses.index')->with('success', 'Gudang berhasil dihapus.');
        }
        catch (\Exception $e) {
            return redirect()->route('master.warehouses.index')->with('error', 'Gudang tidak dapat dihapus.');
        }
    }
}
