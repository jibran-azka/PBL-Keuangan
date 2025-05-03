<form action="{{ route('transaksi.store') }}" method="POST">
    @csrf

    <label>Jenis</label>
    <select name="jenis" required>
        <option value="pemasukan">Pemasukan</option>
        <option value="pengeluaran">Pengeluaran</option>
    </select>

    <label>Jumlah</label>
    <input type="number" name="jumlah" step="0.01" required>

    <label>Keterangan</label>
    <input type="text" name="keterangan">

    <label>Akun</label>
    <select name="account_id" required>
        @foreach ($accounts as $account)
            <option value="{{ $account->id }}">{{ $account->nama }}</option>
        @endforeach
    </select>

    <label>Tanggal</label>
    <input type="date" name="tanggal" required>

    <button type="submit">Simpan</button>
</form>
