<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\PurchaseInvoice;
use App\Models\PurchasePayment;
use Illuminate\Http\Request;

class PurchasePaymentController extends Controller
{
    public function index()
    {
        $payments = PurchasePayment::with('purchaseInvoice.purchaseOrder.supplier')->latest()->get();
        return view('finance.purchase-payments.index', compact('payments'));
    }

    public function create(Request $request)
    {
        $invoice = PurchaseInvoice::with('purchaseOrder.supplier')->findOrFail($request->get('purchase_invoice_id'));
        return view('finance.purchase-payments.create', compact('invoice'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'purchase_invoice_id' => 'required|exists:purchase_invoices,id',
            'paid_at' => 'required|date',
            'amount' => 'required|numeric|min:1',
            'method' => 'required|in:TRANSFER,CASH,GIRO',
        ]);

        $code = 'PPAY-' . date('Ymd') . '-' . str_pad(PurchasePayment::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

        $payment = PurchasePayment::create(array_merge($request->all(), [
            'code' => $code, 'status' => 'CONFIRMED', 'created_by' => auth()->id(),
        ]));

        $invoice = PurchaseInvoice::find($request->purchase_invoice_id);
        $totalPaid = $invoice->payments()->where('status', 'CONFIRMED')->sum('amount');
        if ($totalPaid >= $invoice->total) {
            $invoice->update(['status' => 'PAID']);
        }

        return redirect()->route('finance.purchase-payments.show', $payment)->with('success', 'Pembayaran berhasil dicatat.');
    }

    public function show(PurchasePayment $purchasePayment)
    {
        $purchasePayment->load(['purchaseInvoice.purchaseOrder.supplier', 'createdBy']);
        return view('finance.purchase-payments.show', compact('purchasePayment'));
    }

    public function edit(PurchasePayment $purchasePayment)
    {
        abort(403);
    }
    public function update(Request $request, PurchasePayment $purchasePayment)
    {
        abort(403);
    }
    public function destroy(PurchasePayment $purchasePayment)
    {
        abort(403);
    }
}
