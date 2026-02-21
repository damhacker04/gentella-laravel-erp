<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\SalesInvoice;
use App\Models\XenditPayment;
use App\Services\XenditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class XenditPaymentController extends Controller
{
    /**
     * List all Xendit payments.
     */
    public function index(Request $request)
    {
        $query = XenditPayment::with(['salesInvoice', 'createdBy']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->latest()->get();
        return view('finance.xendit-payments.index', compact('payments'));
    }

    /**
     * Create a Xendit Invoice for a Sales Invoice.
     */
    public function create(SalesInvoice $salesInvoice)
    {
        abort_if($salesInvoice->status !== 'POSTED', 403, 'Hanya faktur POSTED yang bisa dibayar via Xendit.');

        // Check if there's already a pending xendit payment
        $existing = XenditPayment::where('sales_invoice_id', $salesInvoice->id)
            ->where('status', 'PENDING')
            ->first();

        if ($existing) {
            return redirect()->route('finance.xendit-payments.show', $existing)
                ->with('info', 'Sudah ada pembayaran Xendit yang masih pending untuk faktur ini.');
        }

        $externalId = 'INV-' . $salesInvoice->code . '-' . time();

        $xenditService = new XenditService();
        $result = $xenditService->createInvoice([
            'external_id' => $externalId,
            'amount' => $salesInvoice->total,
            'payer_email' => $salesInvoice->salesOrder->customer->email ?? 'customer@example.com',
            'description' => "Pembayaran {$salesInvoice->code}",
            'success_redirect_url' => route('finance.xendit-payments.index'),
            'failure_redirect_url' => route('finance.xendit-payments.index'),
        ]);

        if (isset($result['error'])) {
            return redirect()->route('sales.invoices.show', $salesInvoice)
                ->with('error', 'Xendit Error: ' . $result['error']);
        }

        $response = $result;

        if (!$response) {
            return redirect()->route('sales.invoices.show', $salesInvoice)
                ->with('error', 'Gagal membuat invoice Xendit. Silakan coba lagi.');
        }

        $payment = XenditPayment::create([
            'sales_invoice_id' => $salesInvoice->id,
            'xendit_invoice_id' => $response['id'],
            'external_id' => $externalId,
            'amount' => $response['amount'],
            'status' => 'PENDING',
            'invoice_url' => $response['invoice_url'],
            'xendit_response' => $response,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('finance.xendit-payments.show', $payment)
            ->with('success', 'Invoice Xendit berhasil dibuat! Klik link pembayaran untuk melanjutkan.');
    }

    /**
     * Show payment detail.
     */
    public function show(XenditPayment $xenditPayment)
    {
        $xenditPayment->load(['salesInvoice.salesOrder.customer', 'createdBy']);
        return view('finance.xendit-payments.show', compact('xenditPayment'));
    }

    /**
     * Check & refresh payment status from Xendit API.
     */
    public function refresh(XenditPayment $xenditPayment)
    {
        if ($xenditPayment->status !== 'PENDING') {
            return redirect()->route('finance.xendit-payments.show', $xenditPayment)
                ->with('info', 'Status sudah final: ' . $xenditPayment->status);
        }

        $xenditService = new XenditService();
        $response = $xenditService->getInvoice($xenditPayment->xendit_invoice_id);

        if ($response) {
            $newStatus = strtoupper($response['status']);
            $xenditPayment->update([
                'status' => $newStatus,
                'payment_method' => $response['payment_method'] ?? null,
                'payment_channel' => $response['payment_channel'] ?? null,
                'paid_at' => ($newStatus === 'PAID') ? now() : null,
                'xendit_response' => $response,
            ]);

            // If paid, update invoice status
            if ($newStatus === 'PAID') {
                $xenditPayment->salesInvoice->update(['status' => 'PAID']);
            }
        }

        return redirect()->route('finance.xendit-payments.show', $xenditPayment)
            ->with('success', 'Status berhasil diperbarui.');
    }

    /**
     * Webhook callback from Xendit (no auth required).
     */
    public function webhook(Request $request)
    {
        Log::info('Xendit Webhook received', $request->all());

        // Validate callback token if set
        $callbackToken = config('services.xendit.callback_token');
        if ($callbackToken && $request->header('x-callback-token') !== $callbackToken) {
            Log::warning('Xendit Webhook: invalid callback token');
            return response()->json(['message' => 'Invalid token'], 403);
        }

        $externalId = $request->input('external_id');
        $status = strtoupper($request->input('status'));

        $payment = XenditPayment::where('external_id', $externalId)->first();

        if (!$payment) {
            Log::warning('Xendit Webhook: payment not found', ['external_id' => $externalId]);
            return response()->json(['message' => 'Not found'], 404);
        }

        $payment->update([
            'status' => $status,
            'payment_method' => $request->input('payment_method'),
            'payment_channel' => $request->input('payment_channel'),
            'paid_at' => ($status === 'PAID') ? now() : null,
            'xendit_response' => $request->all(),
        ]);

        // If paid, update invoice status
        if ($status === 'PAID') {
            $payment->salesInvoice->update(['status' => 'PAID']);
        }

        return response()->json(['message' => 'OK']);
    }
}
