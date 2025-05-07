@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Akun</h2>

    <form action="{{ route('akun.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1 text-gray-700">Nama Akun</label>
            <input type="text" name="nama_akun" required class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
    </form>
</div>
@endsection
