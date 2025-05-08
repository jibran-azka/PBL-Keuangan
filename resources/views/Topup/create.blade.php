@extends('layouts.app')

@section('content')
<div class="max-w-5xl px-4 py-8 mx-auto">
    <h2 class="mb-6 text-2xl font-semibold text-gray-800">Top Up Saldo</h2>

    <!-- Form untuk melakukan top-up -->
    <form action="{{ route('topup.store') }}" method="POST">
        @csrf
        <!-- Dropdown Pilih Akun -->
        <div class="mb-4">
            <label for="account_id" class="block text-sm font-medium text-gray-700">Pilih Akun</label>
            <select name="account_id" id="account_id" class="w-full mt-1 border-gray-300 rounded shadow-sm">
                @foreach($accounts as $account)
                    <option value="{{ $account->id }}">{{ $account->nama_akun }}</option>
                @endforeach
            </select>
        </div>

        <!-- Input untuk jumlah top-up -->
        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700">Jumlah Top Up</label>
            <input type="number" id="amount" name="amount" min="1000" step="1000" required
                   class="mt-1 block w-full px-4 py-2 text-sm text-gray-800 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukkan jumlah top-up">
            @error('amount')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol submit untuk mengonfirmasi top-up -->
        <div>
            <button type="submit" class="px-6 py-2 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">
                Top Up
            </button>
        </div>
    </form>
    <!-- Status transaksi top-up -->
    <div class="mt-4">
        <h3 class="text-xl font-semibold text-gray-700">Status Transaksi</h3>
        <p class="mt-2 text-sm text-gray-600">Status: <span class="font-bold text-blue-500">Pending</span></p>
        <!-- Anda bisa mengganti status ini sesuai status transaksi yang sebenarnya -->
    </div>
</div>
@endsection
