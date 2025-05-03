<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::where('user_id', auth()->id())->with('transactions')->get();
        return view('account.index', compact('accounts'));
    }

    public function create()
    {
        return view('account.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Account::create([
            'user_id' => auth()->id(),
            'nama' => $request->nama,
        ]);

        return redirect()->route('account.index')->with('success', 'Akun berhasil ditambahkan.');
    }

    public function edit(Account $account)
    {
        $this->authorize('update', $account); // opsional: proteksi user
        return view('account.edit', compact('account'));
    }

    public function update(Request $request, Account $account)
    {
        $this->authorize('update', $account);

        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $account->update(['nama' => $request->nama]);

        return redirect()->route('account.index')->with('success', 'Akun berhasil diperbarui.');
    }
}
