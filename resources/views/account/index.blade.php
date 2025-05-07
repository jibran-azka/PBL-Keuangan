@extends('layouts.app') {{-- Ganti sesuai layout utama kamu --}}

@section('content')
<div class="max-w-5xl px-4 py-8 mx-auto">
    <h2 class="mb-6 text-2xl font-semibold text-gray-800">Daftar Akun Keuangan</h2>

    <div class="mb-4">
        <a href="{{ route('akun.create') }}"
           class="inline-block px-4 py-2 text-sm text-white bg-green-500 rounded hover:bg-green-600">
            Tambah Akun
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-xl">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="text-sm text-left text-gray-700 bg-gray-100">
                <tr>
                    <th class="px-6 py-3">Nama Akun</th>
                    <th class="px-6 py-3">Saldo</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-800 bg-white divide-y divide-gray-200">
                @foreach ($accounts as $account)
                <tr>
                    <td class="px-6 py-4">{{ $account->nama_akun }}</td>
                    <td class="px-6 py-4">
                        Rp{{ number_format($account->transactions->sum(fn($t) => $t->jenis === 'pemasukan' ? $t->jumlah : -$t->jumlah), 2, ',', '.') }}
                    </td>
                    <td class="flex gap-2 px-6 py-4">
                        <a href="{{ route('akun.edit', $account->id) }}"
                           class="px-4 py-2 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">
                            Edit
                        </a>

                        <form action="{{ route('akun.destroy', $account->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 text-sm text-white bg-red-500 rounded hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
