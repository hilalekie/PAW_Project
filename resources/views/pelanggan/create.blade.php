<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan - Mabarin Admin</title>
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
                    <a href="{{ route('users.index') }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">Users</a>
                    <a href="{{ route('pelanggan.index') }}" class="px-3 py-2 rounded-lg bg-blue-50 text-blue-600 font-semibold">Pelanggan</a>
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

        <main class="max-w-3xl mx-auto px-6 py-10 w-full">
            
            <div class="mb-8 text-center flex justify-center items-center gap-2 text-xs font-bold text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span>Dashboard</span>
                <span>/</span>
                <span>Pelanggan</span>
                <span>/</span>
                <span class="text-blue-600">Tambah Baru</span>
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

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 mb-6">
                
        
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">Tambah Pelanggan</h1>
                        <p class="text-xs text-gray-500 mt-1">Formulir pendaftaran dan pembaruan member/pelanggan</p>
                    </div>
                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    </div>
                </div>

                <!-- Form Input -->
                <form action="{{ route('pelanggan.store') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1.5 flex items-center gap-1">
                            Nama Pelanggan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required placeholder="Masukkan nama lengkap pelanggan"
                                   class="w-full border border-gray-300 rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-gray-50/50">
                        </div>
                    </div>

                    <div>
                        <label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-1.5 flex items-center gap-1">
                            Nomor HP <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required placeholder="Contoh: 081234567890"
                                   class="w-full border border-gray-300 rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-gray-50/50">
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label for="alamat" class="block text-sm font-semibold text-gray-700 flex items-center gap-1">
                                Alamat <span class="text-red-500">*</span>
                            </label>
                            <span class="text-[10px] text-gray-400 font-medium">Gunakan '-' jika tidak ada domisili tetap</span>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 pt-3.5 pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <textarea id="alamat" name="alamat" required rows="3" placeholder="Masukkan alamat lengkap atau '-' jika tidak ada"
                                   class="w-full border border-gray-300 rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-gray-50/50 resize-none">{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <a href="{{ route('pelanggan.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-xs font-bold transition flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold shadow-sm transition flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Kotak Informasi Kasir -->
            <div class="bg-blue-50/50 border border-blue-100 rounded-xl p-4 flex gap-3 text-blue-800 text-[11px] leading-relaxed">
                <svg class="w-5 h-5 text-blue-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p><strong>Pemberitahuan Kasir:</strong> Nomor HP yang terdaftar akan otomatis terhubung ke sistem loyalty lounge untuk pengumpulan poin waktu bermain PS5 & PS4 Pro serta verifikasi peminjaman stik dualsense ekstra.</p>
            </div>

        </main>
    </div>


    <footer class="max-w-7xl mx-auto w-full px-6 py-6 flex justify-between items-center text-[11px] text-gray-400 border-t border-gray-200 mt-12">
        <p>© 2026 Mabarin PlayStation Lounge Management</p>
        <p>System Rental v1.0</p>
    </footer>

</body>
</html>