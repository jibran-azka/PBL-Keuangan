@extends('layouts.app') {{-- Ganti sesuai layout utama kamu --}}

@section('content')
<div class="max-w-xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Nama Akun</h2>

    <form action="{{ route('akun.update', $account->id) }}" method="POST" class="bg-white p-6 rounded-xl shadow-md space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="nama_akun" class="block text-sm font-medium text-gray-700">Nama Akun</label>
            <input type="text" name="nama_akun" id="nama_akun"
                   value="{{ $account->nama }}"
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm font-medium">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
