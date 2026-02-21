<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class XenditService
{
    protected string $baseUrl = 'https://api.xendit.co';
    protected string $secretKey;

    public function __construct()
    {
        $this->secretKey = config('services.xendit.secret_key');
    }

    /**
     * Create a Xendit Invoice.
     *
     * @param array $data  ['external_id', 'amount', 'payer_email', 'description', 'success_redirect_url']
     * @return array|null  Xendit API response as array
     */
    public function createInvoice(array $data): ?array
    {
        $payload = [
            'external_id' => $data['external_id'],
            'amount' => (int)$data['amount'],
            'payer_email' => $data['payer_email'] ?? 'customer@example.com',
            'description' => $data['description'] ?? 'Pembayaran Invoice',
            'invoice_duration' => 86400, // 24 hours
            'currency' => 'IDR',
            'success_redirect_url' => $data['success_redirect_url'] ?? url('/'),
            'failure_redirect_url' => $data['failure_redirect_url'] ?? url('/'),
        ];

        try {
            $response = Http::withBasicAuth($this->secretKey, '')
                ->post("{$this->baseUrl}/v2/invoices", $payload);

            if ($response->successful()) {
                return $response->json();
            }

            $body = $response->json();
            $errorMessage = $body['message'] ?? $response->body();

            Log::error('Xendit createInvoice failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return ['error' => "({$response->status()}) {$errorMessage}"];
        }
        catch (\Exception $e) {
            Log::error('Xendit createInvoice exception', ['error' => $e->getMessage()]);
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Get invoice detail from Xendit.
     */
    public function getInvoice(string $invoiceId): ?array
    {
        try {
            $response = Http::withBasicAuth($this->secretKey, '')
                ->get("{$this->baseUrl}/v2/invoices/{$invoiceId}");

            return $response->successful() ? $response->json() : null;
        }
        catch (\Exception $e) {
            Log::error('Xendit getInvoice exception', ['error' => $e->getMessage()]);
            return null;
        }
    }
}
