@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white shadow-md rounded-2xl p-6 border-l-4 border-blue-500">
            <p class="text-gray-600 mb-1">Total Saldo</p>
            <p class="text-3xl font-bold text-blue-600">Rp {{ number_format($totalSaldo) }}</p>
        </div>
        <div class="bg-white shadow-md rounded-2xl p-6 border-l-4 border-green-500">
            <p class="text-gray-600 mb-1">Pemasukan Bulan Ini</p>
            <p class="text-3xl font-bold text-green-600">Rp {{ number_format($pemasukan) }}</p>
        </div>
        <div class="bg-white shadow-md rounded-2xl p-6 border-l-4 border-red-500">
            <p class="text-gray-600 mb-1">Pengeluaran Bulan Ini</p>
            <p class="text-3xl font-bold text-red-600">Rp {{ number_format($pengeluaran) }}</p>
        </div>
    </div>

    <!-- Grafik -->
    <div class="bg-white shadow-md rounded-2xl p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Grafik Keuangan Bulanan</h2>
        <canvas id="grafikKeuangan" height="120"></canvas>
    </div>

    <!-- Tabel Transaksi -->
    <div class="bg-white shadow-md rounded-2xl p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Riwayat Transaksi Terakhir</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($riwayat as $trx)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $trx->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold 
                                {{ $trx->jenis === 'pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                                {{ ucfirst($trx->jenis) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $trx->keterangan ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                Rp {{ number_format($trx->jumlah) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('grafikKeuangan').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($bulan) !!}, // contoh: ['Jan', 'Feb', 'Mar']
            datasets: [
                {
                    label: 'Pemasukan',
                    backgroundColor: '#22c55e',
                    data: {!! json_encode($dataPemasukan) !!}, // array angka
                },
                {
                    label: 'Pengeluaran',
                    backgroundColor: '#ef4444',
                    data: {!! json_encode($dataPengeluaran) !!}, // array angka
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
