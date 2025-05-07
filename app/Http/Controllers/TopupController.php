<?php

namespace App\Http\Controllers;

use App\Models\TopUp;
use Illuminate\Http\Request;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use Illuminate\Support\Facades\Log;

class TopupController extends Controller
{
    public function index()
    {
        $topUps = TopUp::all(); // Mengambil semua data top-up
        return view('topup.index', compact('topUps'));
    }

    public function create()
    {
        $accounts = Account::all(); // Tampilkan semua akun supaya user bisa pilih
        return view('topup.create', compact('accounts'));
    }

    public function store(Request $request, MidtransService $midtrans)
    {
        // Validasi input
        $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'amount' => 'required|integer|min:1000',
        ]);

        // Buat record top-up di tabel top_ups
        $topUp = TopUp::create([
            'user_id' => Auth::id(),
            'account_id' => $request->account_id,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        // Persiapkan parameter untuk transaksi Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => 'TOPUP-' . $topUp->id . '-' . time(),
                'gross_amount' => $topUp->amount,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        // Buat transaksi dengan Midtrans
        $snap = $midtrans->createTransaction($params);

        // Cek apakah transaksi berhasil dan snap token ada
        if ($snap && isset($snap->token)) {
            // Simpan token dari transaksi ke dalam database
            $topUp->snap_token = $snap->token;
            $topUp->status = 'awaiting_payment'; // Update status transaksi
            $topUp->save();

            // Kembalikan tampilan untuk melanjutkan pembayaran
            return view('topup.pay', compact('snap'));
        } else {
            // Jika transaksi gagal atau token tidak ditemukan, log error dan beri pesan kesalahan
            Log::error('Midtrans transaction failed', ['params' => $params, 'response' => $snap]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses transaksi.');
        }
    }

    public function show($id)
    {
        $topUp = TopUp::findOrFail($id);
        return view('topup.show', compact('topUp'));
    }

    public function edit($id)
    {
        $topUp = TopUp::findOrFail($id);
        return view('topup.edit', compact('topUp'));
    }

    public function update(Request $request, $id)
    {
        $topUp = TopUp::findOrFail($id);
        $topUp->update($request->all());
        return redirect()->route('topup.index');
    }

    public function destroy($id)
    {
        $topUp = TopUp::findOrFail($id);
        $topUp->delete();
        return redirect()->route('topup.index');
    }
    // app/Http/Controllers/TopupController.php
    public function simulate()
    {
        // Logika untuk simulasi pembayaran
        return redirect()->route('topup.index')->with('status', 'Pembayaran berhasil (simulasi).');
    }


}
