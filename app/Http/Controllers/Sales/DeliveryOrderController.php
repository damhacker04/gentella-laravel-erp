<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\DeliveryOrder;
use App\Models\SalesOrder;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class DeliveryOrderController extends Controller
{
    public function index()
    {
        $deliveryOrders = DeliveryOrder::with(['salesOrder.customer', 'warehouse'])->latest()->get();
        return view('sales.delivery-orders.index', compact('deliveryOrders'));
    }

    public function create(Request $request)
    {
        $salesOrder = SalesOrder::with('items.product')->findOrFail($request->get('sales_order_id'));
        abort_if($salesOrder->status !== 'CONFIRMED', 403, 'SO harus CONFIRMED.');
        $warehouses = Warehouse::where('is_active', true)->get();
        return view('sales.delivery-orders.create', compact('salesOrder', 'warehouses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sales_order_id' => 'required|exists:sales_orders,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'delivered_at' => 'required|date',
            'items' => 'required|array|min:1',
        ]);

        $code = 'DO-' . date('Ymd') . '-' . str_pad(DeliveryOrder::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

        $do = DeliveryOrder::create([
            'code' => $code,
            'sales_order_id' => $request->sales_order_id,
            'warehouse_id' => $request->warehouse_id,
            'delivered_at' => $request->delivered_at,
            'notes' => $request->notes,
            'status' => 'DRAFT',
            'created_by' => auth()->id(),
        ]);

        foreach ($request->items as $item) {
            $do->items()->create([
                'product_id' => $item['product_id'],
                'qty_ordered' => $item['qty_ordered'],
                'qty_delivered' => $item['qty_delivered'],
            ]);
        }

        return redirect()->route('sales.delivery-orders.show', $do)->with('success', 'Delivery Order berhasil dibuat.');
    }

    public function show(DeliveryOrder $deliveryOrder)
    {
        $deliveryOrder->load(['salesOrder.customer', 'warehouse', 'items.product', 'createdBy']);
        return view('sales.delivery-orders.show', compact('deliveryOrder'));
    }

    public function edit(DeliveryOrder $deliveryOrder)
    {
        abort_if($deliveryOrder->status !== 'DRAFT', 403);
        $deliveryOrder->load(['salesOrder.items.product', 'items']);
        $warehouses = Warehouse::where('is_active', true)->get();
        return view('sales.delivery-orders.edit', compact('deliveryOrder', 'warehouses'));
    }

    public function update(Request $request, DeliveryOrder $deliveryOrder)
    {
        abort_if($deliveryOrder->status !== 'DRAFT', 403);

        $deliveryOrder->update($request->only(['warehouse_id', 'delivered_at', 'notes']));
        $deliveryOrder->items()->delete();
        foreach ($request->items as $item) {
            $deliveryOrder->items()->create([
                'product_id' => $item['product_id'],
                'qty_ordered' => $item['qty_ordered'],
                'qty_delivered' => $item['qty_delivered'],
            ]);
        }

        return redirect()->route('sales.delivery-orders.show', $deliveryOrder)->with('success', 'Delivery Order diperbarui.');
    }

    public function destroy(DeliveryOrder $deliveryOrder)
    {
        abort_if($deliveryOrder->status !== 'DRAFT', 403);
        $deliveryOrder->delete();
        return redirect()->route('sales.delivery-orders.index')->with('success', 'Delivery Order dihapus.');
    }
}
