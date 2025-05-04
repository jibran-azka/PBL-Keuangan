<h2>Edit Nama Akun</h2>

<form action="{{ route('akun.update', $account->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Akun</label>
    <input type="text" name="nama_akun" value="{{ $account->nama }}" required>

    <button type="submit">Update</button>
</form>
