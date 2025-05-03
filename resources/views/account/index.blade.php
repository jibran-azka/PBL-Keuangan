<h2>Daftar Akun Keuangan</h2>

<table border="1">
    <thead>
        <tr>
            <th>Nama Akun</th>
            <th>Saldo</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($accounts as $account)
        <tr>
            <td>{{ $account->nama }}</td>
            <td>Rp{{ number_format($account->transactions->sum(fn($t) => $t->jenis === 'pemasukan' ? $t->jumlah : -$t->jumlah), 2) }}</td>
            <td>
                <a href="{{ route('account.edit', $account->id) }}">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
