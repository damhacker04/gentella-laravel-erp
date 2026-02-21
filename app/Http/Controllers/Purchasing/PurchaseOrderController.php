<?php

namespace App\Http\Controllers\Purchasing;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $orders = PurchaseOrder::with('supplier')->latest()->get();
        return view('purchasing.orders.index', compact('orders'));
    }

    public function create()
    {
        $suppliers = Supplier::where('is_active', true)->orderBy('name')->get();
        $products = Product::where('is_active', true)->orderBy('name')->get();
        return view('purchasing.orders.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'order_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $code = 'PO-' . date('Ymd') . '-' . str_pad(PurchaseOrder::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
        $total = 0;

        $order = PurchaseOrder::create([
            'code' => $code, 'supplier_id' => $request->supplier_id,
            'order_date' => $request->order_date, 'notes' => $request->notes,
            'status' => 'DRAFT', 'total' => 0, 'created_by' => auth()->id(),
        ]);

        foreach ($request->items as $item) {
            $subtotal = $item['qty'] * $item['price'];
            $total += $subtotal;
            $order->items()->create([
                'product_id' => $item['product_id'], 'qty' => $item['qty'],
                'price' => $item['price'], 'subtotal' => $subtotal,
            ]);
        }
        $order->update(['total' => $total]);

        return redirect()->route('purchasing.orders.show', $order)->with('success', 'Purchase Order berhasil dibuat.');
    }

    public function show(PurchaseOrder $order)
    {
        $order->load(['supplier', 'items.product', 'goodsReceipts', 'invoices', 'createdBy']);
        return view('purchasing.orders.show', compact('order'));
    }

    public function edit(PurchaseOrder $order)
    {
        abort_if($order->status !== 'DRAFT', 403);
        $order->load('items');
        $suppliers = Supplier::where('is_active', true)->orderBy('name')->get();
        $products = Product::where('is_active', true)->orderBy('name')->get();
        return view('purchasing.orders.edit', compact('order', 'suppliers', 'products'));
    }

    public function update(Request $request, PurchaseOrder $order)
    {
        abort_if($order->status !== 'DRAFT', 403);
        $order->update($request->only(['supplier_id', 'order_date', 'notes']));
        $order->items()->delete();
        $total = 0;
        foreach ($request->items as $item) {
            $subtotal = $item['qty'] * $item['price'];
            $total += $subtotal;
            $order->items()->create(['product_id' => $item['product_id'], 'qty' => $item['qty'], 'price' => $item['price'], 'subtotal' => $subtotal]);
        }
        $order->update(['total' => $total]);
        return redirect()->route('purchasing.orders.show', $order)->with('success', 'PO diperbarui.');
    }

    public function destroy(PurchaseOrder $order)
    {
        abort_if($order->status !== 'DRAFT', 403);
        $order->delete();
        return redirect()->route('purchasing.orders.index')->with('success', 'PO dihapus.');
    }

    public function confirm(PurchaseOrder $order)
    {
        abort_if($order->status !== 'DRAFT', 403);
        $order->update(['status' => 'CONFIRMED']);
        return redirect()->route('purchasing.orders.show', $order)->with('success', 'PO dikonfirmasi.');
    }

    public function cancel(PurchaseOrder $order)
    {
        abort_if(!in_array($order->status, ['DRAFT', 'CONFIRMED']), 403);
        $order->update(['status' => 'CANCELLED']);
        return redirect()->route('purchasing.orders.show', $order)->with('success', 'PO dibatalkan.');
    }
}
