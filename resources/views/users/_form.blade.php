<div class="mb-3">
    <label>Nama</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}">
    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
</div>
<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}">
    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
</div>
<div class="mb-3">
    <label>Password @isset($user) <small class="text-muted">(kosongkan jika tidak diganti)</small> @endisset</label>
    <input type="password" name="password" class="form-control">
    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
</div>
<button class="btn btn-primary">Simpan</button>
<a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>