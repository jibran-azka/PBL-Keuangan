@extends('layouts.app')

@section('content')
<div class="max-w-5xl px-4 py-8 mx-auto">
    <h2 class="mb-6 text-2xl font-semibold text-gray-800">Proses Pembayaran Top Up Saldo</h2>

    <!-- Script untuk integrasi Midtrans -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script type="text/javascript">
        window.onload = function () {
            snap.pay('{{ $snap->token }}', {
                onSuccess: function(result) {
                    window.location.href = '/topup/success'; // Redirect ke halaman sukses setelah pembayaran
                },
                onPending: function(result) {
                    window.location.href = '/topup/pending'; // Redirect ke halaman pending setelah pembayaran
                },
                onError: function(result) {
                    window.location.href = '/topup/failed'; // Redirect ke halaman gagal setelah pembayaran
                }
            });
        }
    </script>

    <!-- Menampilkan pesan loading -->
    <p class="mt-4 text-sm text-gray-600">Harap tunggu, Anda akan diarahkan ke halaman pembayaran...</p>

    <!-- Tombol simulasi bayar (dummy payment gateway) -->
    <div class="mt-4">
        <button class="px-6 py-2 text-sm text-white bg-green-500 rounded hover:bg-green-600" onclick="window.location.href = '{{ route('topup.simulate') }}'">
            Simulasi Bayar
        </button>
    </div>

    <!-- Status transaksi top-up -->
    <div class="mt-6">
        <h3 class="text-xl font-semibold text-gray-700">Status Transaksi</h3>
        <p class="mt-2 text-sm text-gray-600">Status: <span class="font-bold text-blue-500">Pending</span></p>
        <!-- Ganti status ini sesuai dengan status transaksi yang sebenarnya -->
    </div>
</div>
@endsection
