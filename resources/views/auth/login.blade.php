<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Rental PS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container" style="max-width: 400px; margin-top: 100px;">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="text-center mb-3">Login Rental PS</h4>
            <form method="POST" action="{{ url('/login') }}">
                @csrf
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button class="btn btn-primary w-100">Login</button>
            </form>
                            <button class="btn btn-primary w-100">Login</button>
            </form>
            <p class="text-center mt-3 mb-0"><a href="{{ route('ketersediaan') }}">Cek Ketersediaan</a></p>
        </div>
    </div>
</div>
</body>
</html>
