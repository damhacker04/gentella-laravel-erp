<?php

namespace App\Http\Controllers\Purchasing;

use App\Http\Controllers\Controller;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseInvoiceController extends Controller
{
    public function index()
    {
        $invoices = PurchaseInvoice::with('purchaseOrder.supplier')->latest()->get();
        return view('purchasing.invoices.index', compact('invoices'));
    }

    public function create(Request $request)
    {
        $purchaseOrder = PurchaseOrder::with('items.product')->findOrFail($request->get('purchase_order_id'));
        return view('purchasing.invoices.create', compact('purchaseOrder'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
        ]);

        $po = PurchaseOrder::with('items')->findOrFail($request->purchase_order_id);
        $code = 'PINV-' . date('Ymd') . '-' . str_pad(PurchaseInvoice::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

        $invoice = PurchaseInvoice::create([
            'code' => $code, 'purchase_order_id' => $po->id,
            'invoice_date' => $request->invoice_date, 'due_date' => $request->due_date,
            'notes' => $request->notes, 'status' => 'DRAFT', 'total' => $po->total, 'created_by' => auth()->id(),
        ]);

        foreach ($po->items as $item) {
            $invoice->items()->create([
                'product_id' => $item->product_id, 'qty' => $item->qty,
                'price' => $item->price, 'subtotal' => $item->subtotal,
            ]);
        }

        return redirect()->route('purchasing.invoices.show', $invoice)->with('success', 'Faktur pembelian berhasil dibuat.');
    }

    public function show(PurchaseInvoice $invoice)
    {
        $invoice->load(['purchaseOrder.supplier', 'items.product', 'payments', 'createdBy']);
        return view('purchasing.invoices.show', compact('invoice'));
    }

    public function edit(PurchaseInvoice $invoice)
    {
        abort_if($invoice->status !== 'DRAFT', 403);
        return view('purchasing.invoices.edit', compact('invoice'));
    }

    public function update(Request $request, PurchaseInvoice $invoice)
    {
        abort_if($invoice->status !== 'DRAFT', 403);
        $invoice->update($request->only(['invoice_date', 'due_date', 'notes']));
        return redirect()->route('purchasing.invoices.show', $invoice)->with('success', 'Faktur pembelian diperbarui.');
    }

    public function destroy(PurchaseInvoice $invoice)
    {
        abort_if($invoice->status !== 'DRAFT', 403);
        $invoice->delete();
        return redirect()->route('purchasing.invoices.index')->with('success', 'Faktur dihapus.');
    }

    public function post(PurchaseInvoice $invoice)
    {
        abort_if($invoice->status !== 'DRAFT', 403);
        $invoice->update(['status' => 'POSTED']);
        return redirect()->route('purchasing.invoices.show', $invoice)->with('success', 'Faktur di-posting.');
    }
}
