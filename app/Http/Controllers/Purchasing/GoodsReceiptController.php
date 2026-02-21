<?php

namespace App\Http\Controllers\Purchasing;

use App\Http\Controllers\Controller;
use App\Models\GoodsReceipt;
use App\Models\PurchaseOrder;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class GoodsReceiptController extends Controller
{
    public function index()
    {
        $goodsReceipts = GoodsReceipt::with(['purchaseOrder.supplier', 'warehouse'])->latest()->get();
        return view('purchasing.goods-receipts.index', compact('goodsReceipts'));
    }

    public function create(Request $request)
    {
        $purchaseOrder = PurchaseOrder::with('items.product')->findOrFail($request->get('purchase_order_id'));
        abort_if($purchaseOrder->status !== 'CONFIRMED', 403, 'PO harus CONFIRMED.');
        $warehouses = Warehouse::where('is_active', true)->get();
        return view('purchasing.goods-receipts.create', compact('purchaseOrder', 'warehouses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'received_at' => 'required|date',
            'items' => 'required|array|min:1',
        ]);

        $code = 'GRN-' . date('Ymd') . '-' . str_pad(GoodsReceipt::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

        $grn = GoodsReceipt::create([
            'code' => $code, 'purchase_order_id' => $request->purchase_order_id,
            'warehouse_id' => $request->warehouse_id, 'received_at' => $request->received_at,
            'notes' => $request->notes, 'status' => 'DRAFT', 'created_by' => auth()->id(),
        ]);

        foreach ($request->items as $item) {
            $grn->items()->create([
                'product_id' => $item['product_id'],
                'qty_ordered' => $item['qty_ordered'],
                'qty_received' => $item['qty_received'],
            ]);
        }

        return redirect()->route('purchasing.goods-receipts.show', $grn)->with('success', 'Goods Receipt berhasil dibuat.');
    }

    public function show(GoodsReceipt $goodsReceipt)
    {
        $goodsReceipt->load(['purchaseOrder.supplier', 'warehouse', 'items.product', 'createdBy']);
        return view('purchasing.goods-receipts.show', compact('goodsReceipt'));
    }

    public function edit(GoodsReceipt $goodsReceipt)
    {
        abort_if($goodsReceipt->status !== 'DRAFT', 403);
        $goodsReceipt->load(['purchaseOrder.items.product', 'items']);
        $warehouses = Warehouse::where('is_active', true)->get();
        return view('purchasing.goods-receipts.edit', compact('goodsReceipt', 'warehouses'));
    }

    public function update(Request $request, GoodsReceipt $goodsReceipt)
    {
        abort_if($goodsReceipt->status !== 'DRAFT', 403);
        $goodsReceipt->update($request->only(['warehouse_id', 'received_at', 'notes']));
        $goodsReceipt->items()->delete();
        foreach ($request->items as $item) {
            $goodsReceipt->items()->create([
                'product_id' => $item['product_id'],
                'qty_ordered' => $item['qty_ordered'],
                'qty_received' => $item['qty_received'],
            ]);
        }
        return redirect()->route('purchasing.goods-receipts.show', $goodsReceipt)->with('success', 'GRN diperbarui.');
    }

    public function destroy(GoodsReceipt $goodsReceipt)
    {
        abort_if($goodsReceipt->status !== 'DRAFT', 403);
        $goodsReceipt->delete();
        return redirect()->route('purchasing.goods-receipts.index')->with('success', 'GRN dihapus.');
    }
}
