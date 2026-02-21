<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('xendit_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_invoice_id')->constrained('sales_invoices')->cascadeOnDelete();
            $table->string('xendit_invoice_id')->unique()->nullable();
            $table->string('external_id')->unique();
            $table->decimal('amount', 15, 2);
            $table->string('status', 30)->default('PENDING'); // PENDING, PAID, EXPIRED, FAILED
            $table->string('payment_method')->nullable(); // e.g. BANK_TRANSFER, EWALLET
            $table->string('payment_channel')->nullable(); // e.g. BCA, OVO, DANA
            $table->text('invoice_url')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->json('xendit_response')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('xendit_payments');
    }
};
