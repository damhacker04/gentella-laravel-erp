<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\SalesInvoice;
use App\Models\SalesOrder;
use App\Models\XenditPayment;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $month = now()->month;
        $year = now()->year;

        $salesOrderCount = SalesOrder::whereMonth('created_at', $month)->whereYear('created_at', $year)->count();
        $purchaseOrderCount = PurchaseOrder::whereMonth('created_at', $month)->whereYear('created_at', $year)->count();
        $totalRevenue = XenditPayment::whereIn('status', ['PAID', 'SETTLED'])
            ->whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->sum('amount');
        $unpaidInvoices = SalesInvoice::whereIn('status', ['DRAFT', 'POSTED'])->count();

        $recentSalesOrders = SalesOrder::with('customer')->latest()->take(5)->get();
        $recentPurchaseOrders = PurchaseOrder::with('supplier')->latest()->take(5)->get();

        return view('dashboard', compact('salesOrderCount', 'purchaseOrderCount', 'totalRevenue', 'unpaidInvoices', 'recentSalesOrders', 'recentPurchaseOrders'));
    }
}
