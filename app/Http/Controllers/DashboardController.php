<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\SalesInvoice;
use App\Models\SalesOrder;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $soCount = SalesOrder::whereMonth('created_at', now()->month)->count();
        $poCount = PurchaseOrder::whereMonth('created_at', now()->month)->count();
        $revenue = SalesOrder::where('status', '!=', 'CANCELLED')->whereMonth('created_at', now()->month)->sum('total');
        $unpaid = SalesInvoice::whereIn('status', ['DRAFT', 'POSTED'])->sum('total');

        $recentSO = SalesOrder::with('customer')->latest()->take(5)->get();
        $recentPO = PurchaseOrder::with('supplier')->latest()->take(5)->get();

        return view('dashboard', compact('soCount', 'poCount', 'revenue', 'unpaid', 'recentSO', 'recentPO'));
    }
}
