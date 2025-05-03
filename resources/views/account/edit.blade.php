<h2>Edit Akun</h2>

<form action="{{ route('account.update', $account->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Nama Akun</label>
    <input type="text" name="nama" value="{{ $account->nama }}" required>
    <button type="submit">Update</button>
</form>
