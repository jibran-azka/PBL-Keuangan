<h2>Tambah Akun</h2>

<form action="{{ route('akun.store') }}" method="POST">
    @csrf
    <label>Nama Akun</label>
    <input type="text" name="nama" required>
    <button type="submit">Simpan</button>
</form>
