<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User - Mabarin Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col justify-between">

    <div>
   
        <header class="bg-white border-b border-gray-200 px-8 py-3.5 flex justify-between items-center">
            <div class="flex items-center space-x-8">
                <div class="flex items-center space-x-2">
                    <div class="w-7 h-7 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xs">🎮</div>
                    <span class="font-bold text-gray-900 tracking-tight">Mabarin</span>
                </div>
                
                <nav class="hidden md:flex space-x-1 text-sm font-medium">
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">Dashboard</a>
                    <a href="{{ route('users.index') }}" class="px-3 py-2 rounded-lg bg-blue-50 text-blue-600 font-semibold">Users</a>
                    <a href="{{ route('pelanggan.index') }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">Pelanggan</a>
                    <a href="{{ route('ruangan.index') }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">Ruangan</a>
                    <a href="{{ route('booking.index') }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">Booking</a>
                </nav>
            </div>

            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2 bg-gray-50 px-3 py-1.5 rounded-full border border-gray-200 text-xs font-medium text-gray-700">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    <span>{{ auth()->user()->name ?? 'Admin' }}</span>
                </div>
            </div>
        </header>

        <main class="max-w-2xl mx-auto px-6 py-10 w-full">
            

            <div class="mb-8">
                <div class="text-[11px] font-bold text-blue-600 uppercase tracking-wider mb-1">Manajemen Sistem / Pengguna / Tambah</div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Tambah Akun Petugas</h1>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 text-red-600 text-sm rounded-xl border border-red-100 font-medium">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8">
                <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: Budi Santoso"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="petugas@mabarin.com"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password Akun</label>
                        <input type="password" id="password" name="password" required placeholder="Minimal 8 karakter"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>

                    <div class="pt-6 mt-6 border-t border-gray-100 flex justify-end gap-3">
                        <a href="{{ route('users.index') }}" class="px-6 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-700 border border-gray-200 rounded-xl text-sm font-bold transition">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold shadow-sm transition">
                            Simpan Data Petugas
                        </button>
                    </div>
                </form>
            </div>

        </main>
    </div>

</body>
</html>