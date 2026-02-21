<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\SalesInvoice;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class SalesInvoiceController extends Controller
{
    public function index()
    {
        $invoices = SalesInvoice::with('salesOrder.customer')->latest()->get();
        return view('sales.invoices.index', compact('invoices'));
    }

    public function create(Request $request)
    {
        $salesOrder = SalesOrder::with('items.product')->findOrFail($request->get('sales_order_id'));
        return view('sales.invoices.create', compact('salesOrder'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sales_order_id' => 'required|exists:sales_orders,id',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
        ]);

        $so = SalesOrder::with('items')->findOrFail($request->sales_order_id);
        $code = 'INV-' . date('Ymd') . '-' . str_pad(SalesInvoice::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

        $invoice = SalesInvoice::create([
            'code' => $code,
            'sales_order_id' => $so->id,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'notes' => $request->notes,
            'status' => 'DRAFT',
            'total' => $so->total,
            'created_by' => auth()->id(),
        ]);

        foreach ($so->items as $item) {
            $invoice->items()->create([
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'price' => $item->price,
                'subtotal' => $item->subtotal,
            ]);
        }

        return redirect()->route('sales.invoices.show', $invoice)->with('success', 'Faktur penjualan berhasil dibuat.');
    }

    public function show(SalesInvoice $invoice)
    {
        $invoice->load(['salesOrder.customer', 'items.product', 'payments', 'createdBy']);
        return view('sales.invoices.show', compact('invoice'));
    }

    public function edit(SalesInvoice $invoice)
    {
        abort_if($invoice->status !== 'DRAFT', 403);
        $invoice->load('salesOrder');
        return view('sales.invoices.edit', compact('invoice'));
    }

    public function update(Request $request, SalesInvoice $invoice)
    {
        abort_if($invoice->status !== 'DRAFT', 403);
        $invoice->update($request->only(['invoice_date', 'due_date', 'notes']));
        return redirect()->route('sales.invoices.show', $invoice)->with('success', 'Faktur diperbarui.');
    }

    public function destroy(SalesInvoice $invoice)
    {
        abort_if($invoice->status !== 'DRAFT', 403);
        $invoice->delete();
        return redirect()->route('sales.invoices.index')->with('success', 'Faktur dihapus.');
    }

    public function post(SalesInvoice $invoice)
    {
        abort_if($invoice->status !== 'DRAFT', 403);
        $invoice->update(['status' => 'POSTED']);
        return redirect()->route('sales.invoices.show', $invoice)->with('success', 'Faktur di-posting.');
    }

    public function void(SalesInvoice $invoice)
    {
        abort_if($invoice->status !== 'POSTED', 403);
        $invoice->update(['status' => 'VOID']);
        return redirect()->route('sales.invoices.show', $invoice)->with('success', 'Faktur di-void.');
    }
}
