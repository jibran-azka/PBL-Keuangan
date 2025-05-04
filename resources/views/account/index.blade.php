@extends('layouts.app') {{-- Ganti sesuai layout utama kamu --}}

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Akun Keuangan</h2>

    <div class="mb-4">
        <a href="{{ route('akun.create') }}"
           class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 text-sm">
            Tambah Akun
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-xl shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100 text-gray-700 text-left text-sm">
                <tr>
                    <th class="px-6 py-3">Nama Akun</th>
                    <th class="px-6 py-3">Saldo</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-800">
                @foreach ($accounts as $account)
                <tr>
                    <td class="px-6 py-4">{{ $account->nama_akun }}</td>
                    <td class="px-6 py-4">
                        Rp{{ number_format($account->transactions->sum(fn($t) => $t->jenis === 'pemasukan' ? $t->jumlah : -$t->jumlah), 2, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('akun.edit', $account->id) }}"
                           class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                            Edit
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
