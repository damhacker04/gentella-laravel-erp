<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\SalesInvoice;
use App\Models\SalesPayment;
use Illuminate\Http\Request;

class SalesPaymentController extends Controller
{
    public function index()
    {
        $payments = SalesPayment::with('salesInvoice.salesOrder.customer')->latest()->get();
        return view('finance.sales-payments.index', compact('payments'));
    }

    public function create(Request $request)
    {
        $invoice = SalesInvoice::with('salesOrder.customer')->findOrFail($request->get('sales_invoice_id'));
        return view('finance.sales-payments.create', compact('invoice'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sales_invoice_id' => 'required|exists:sales_invoices,id',
            'paid_at' => 'required|date',
            'amount' => 'required|numeric|min:1',
            'method' => 'required|in:TRANSFER,CASH,GIRO',
        ]);

        $code = 'PAY-' . date('Ymd') . '-' . str_pad(SalesPayment::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

        $payment = SalesPayment::create(array_merge($request->all(), [
            'code' => $code, 'status' => 'CONFIRMED', 'created_by' => auth()->id(),
        ]));

        // Check if invoice is fully paid
        $invoice = SalesInvoice::find($request->sales_invoice_id);
        $totalPaid = $invoice->payments()->where('status', 'CONFIRMED')->sum('amount');
        if ($totalPaid >= $invoice->total) {
            $invoice->update(['status' => 'PAID']);
        }

        return redirect()->route('finance.sales-payments.show', $payment)->with('success', 'Pembayaran berhasil dicatat.');
    }

    public function show(SalesPayment $salesPayment)
    {
        $salesPayment->load(['salesInvoice.salesOrder.customer', 'createdBy']);
        return view('finance.sales-payments.show', compact('salesPayment'));
    }

    public function edit(SalesPayment $salesPayment)
    {
        abort(403);
    }
    public function update(Request $request, SalesPayment $salesPayment)
    {
        abort(403);
    }
    public function destroy(SalesPayment $salesPayment)
    {
        abort(403);
    }
}
