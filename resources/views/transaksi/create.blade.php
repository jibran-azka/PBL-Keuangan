@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-xl p-6 mt-8">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Tambah Transaksi</h2>

    <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-gray-700">Jenis</label>
            <select name="jenis" required class="w-full mt-1 rounded-lg border-gray-300 focus:ring-2 focus:ring-green-500">
                <option value="pemasukan">Pemasukan</option>
                <option value="pengeluaran">Pengeluaran</option>
            </select>
        </div>

        <div>
            <label class="block text-gray-700">Jumlah</label>
            <input type="number" name="jumlah" step="0.01" required class="w-full mt-1 rounded-lg border-gray-300 focus:ring-2 focus:ring-green-500">
        </div>

        <div>
            <label class="block text-gray-700">Keterangan</label>
            <input type="text" name="keterangan" class="w-full mt-1 rounded-lg border-gray-300 focus:ring-2 focus:ring-green-500">
        </div>

        <div>
            <label class="block text-gray-700">Akun</label>
            <select name="account_id" required class="w-full mt-1 rounded-lg border-gray-300 focus:ring-2 focus:ring-green-500">
                @foreach ($accounts as $account)
                    <option value="{{ $account->id }}">{{ $account->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700">Tanggal</label>
            <input type="date" name="tanggal" required class="w-full mt-1 rounded-lg border-gray-300 focus:ring-2 focus:ring-green-500">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-md transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
