<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\PaymentTerm;
use Illuminate\Http\Request;

class PaymentTermController extends Controller
{
    public function index()
    {
        $paymentTerms = PaymentTerm::orderBy('days')->get();
        return view('master.payment-terms.index', compact('paymentTerms'));
    }

    public function create()
    {
        return view('master.payment-terms.create');
    }

    public function store(Request $request)
    {
        $request->validate(['code' => 'required|unique:payment_terms,code', 'name' => 'required', 'days' => 'required|integer|min:0']);
        PaymentTerm::create($request->all());
        return redirect()->route('master.payment-terms.index')->with('success', 'Termin pembayaran berhasil ditambahkan.');
    }

    public function edit(PaymentTerm $paymentTerm)
    {
        return view('master.payment-terms.edit', compact('paymentTerm'));
    }

    public function update(Request $request, PaymentTerm $paymentTerm)
    {
        $request->validate(['code' => 'required|unique:payment_terms,code,' . $paymentTerm->id, 'name' => 'required', 'days' => 'required|integer|min:0']);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $paymentTerm->update($data);
        return redirect()->route('master.payment-terms.index')->with('success', 'Termin pembayaran berhasil diperbarui.');
    }

    public function destroy(PaymentTerm $paymentTerm)
    {
        $paymentTerm->delete();
        return redirect()->route('master.payment-terms.index')->with('success', 'Termin berhasil dihapus.');
    }
}
