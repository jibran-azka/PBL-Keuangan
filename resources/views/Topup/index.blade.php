@extends('layouts.app') <!-- Jika menggunakan layout standar Laravel, ganti sesuai tema yang digunakan -->

@section('content')
<div class="container mt-4">
    <h2>Daftar Top-Up</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Akun</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topUps as $topup)
            <tr>
                <td>{{ $topup->account->nama_akun }}</td>
                <td>Rp{{ number_format($topup->amount, 0, ',', '.') }}</td>
                <td>{{ ucfirst($topup->status) }}</td>
                <td>{{ $topup->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('topup.create') }}" class="btn btn-primary">Kembali</a>
</div>
@endsection
