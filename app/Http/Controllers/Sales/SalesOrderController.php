<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class SalesOrderController extends Controller
{
    public function index()
    {
        $orders = SalesOrder::with('customer')->latest()->get();
        return view('sales.orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::where('is_active', true)->orderBy('name')->get();
        $products = Product::where('is_active', true)->orderBy('name')->get();
        return view('sales.orders.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $code = 'SO-' . date('Ymd') . '-' . str_pad(SalesOrder::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
        $total = 0;

        $order = SalesOrder::create([
            'code' => $code,
            'customer_id' => $request->customer_id,
            'order_date' => $request->order_date,
            'notes' => $request->notes,
            'status' => 'DRAFT',
            'total' => 0,
            'created_by' => auth()->id(),
        ]);

        foreach ($request->items as $item) {
            $subtotal = $item['qty'] * $item['price'];
            $total += $subtotal;
            $order->items()->create([
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $subtotal,
            ]);
        }

        $order->update(['total' => $total]);

        return redirect()->route('sales.orders.show', $order)
            ->with('success', 'Sales Order berhasil dibuat.');
    }

    public function show(SalesOrder $order)
    {
        $order->load(['customer', 'items.product', 'deliveryOrders', 'invoices', 'createdBy']);
        return view('sales.orders.show', compact('order'));
    }

    public function edit(SalesOrder $order)
    {
        abort_if($order->status !== 'DRAFT', 403, 'Hanya SO DRAFT yang bisa diedit.');
        $order->load('items');
        $customers = Customer::where('is_active', true)->orderBy('name')->get();
        $products = Product::where('is_active', true)->orderBy('name')->get();
        return view('sales.orders.edit', compact('order', 'customers', 'products'));
    }

    public function update(Request $request, SalesOrder $order)
    {
        abort_if($order->status !== 'DRAFT', 403);

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'items' => 'required|array|min:1',
        ]);

        $order->update([
            'customer_id' => $request->customer_id,
            'order_date' => $request->order_date,
            'notes' => $request->notes,
        ]);

        $order->items()->delete();
        $total = 0;
        foreach ($request->items as $item) {
            $subtotal = $item['qty'] * $item['price'];
            $total += $subtotal;
            $order->items()->create([
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $subtotal,
            ]);
        }
        $order->update(['total' => $total]);

        return redirect()->route('sales.orders.show', $order)->with('success', 'Sales Order berhasil diperbarui.');
    }

    public function destroy(SalesOrder $order)
    {
        abort_if($order->status !== 'DRAFT', 403);
        $order->delete();
        return redirect()->route('sales.orders.index')->with('success', 'Sales Order berhasil dihapus.');
    }

    public function confirm(SalesOrder $order)
    {
        abort_if($order->status !== 'DRAFT', 403);
        $order->update(['status' => 'CONFIRMED']);
        return redirect()->route('sales.orders.show', $order)->with('success', 'Sales Order dikonfirmasi.');
    }

    public function cancel(SalesOrder $order)
    {
        abort_if(!in_array($order->status, ['DRAFT', 'CONFIRMED']), 403);
        $order->update(['status' => 'CANCELLED']);
        return redirect()->route('sales.orders.show', $order)->with('success', 'Sales Order dibatalkan.');
    }
}
