<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Users - Mabarin Admin</title>
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

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-xs font-semibold text-red-600 hover:text-red-700 px-3 py-1.5 rounded-lg border border-red-100 hover:bg-red-50 transition">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-6 py-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6 flex justify-between items-end">
                <div>
                    <div class="text-[11px] font-bold text-blue-600 uppercase tracking-wider mb-1">Manajemen Sistem / Pengguna</div>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Data Users</h1>
                </div>
                <a href="{{ route('users.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-lg shadow-sm transition flex items-center gap-1.5">
                    <span>+ Tambah</span>
                </a>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <!-- Header Card -->
                <div class="px-6 py-4 bg-gray-50/50 border-b border-gray-200 flex justify-between items-center text-xs">
                    <div class="font-bold text-gray-700 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <span>Daftar Akun Petugas</span>
                    </div>
                    <span class="text-gray-400 font-medium">{{ isset($users) ? $users->count() : 0 }} Pengguna Terdaftar</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 text-[11px] font-bold text-gray-400 uppercase tracking-wider bg-white">
                                <th class="py-3 px-6 w-16 text-center">No</th>
                                <th class="py-3 px-6">Nama</th>
                                <th class="py-3 px-6">Email</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-xs text-gray-700 font-medium">
                            @forelse($users as $index => $user)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-4 px-6 text-center text-gray-400">{{ $index + 1 }}</td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <!-- Avatar Inisial Dinamis -->
                                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-xs uppercase shadow-sm">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                        <span class="font-bold text-gray-900">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-600">{{ $user->email }}</td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('users.edit', $user->id) }}" class="px-2.5 py-1 bg-amber-500 hover:bg-amber-600 text-white rounded font-bold transition text-[10px]">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun user ini?');" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 bg-rose-500 hover:bg-rose-600 text-white rounded font-bold transition text-[10px]">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-12 px-6 text-center text-gray-400 italic">
                                    Belum ada data pengguna terdaftar.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-3.5 bg-gray-50/50 border-t border-gray-200 flex justify-between items-center text-[11px] text-gray-500">
                    <span>Menampilkan seluruh akun aktif</span>
                    <span class="flex items-center gap-1 font-medium text-gray-600">
                        <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Akses Role Terproteksi
                    </span>
                </div>
            </div>
        </main>
    </div>

    <footer class="max-w-7xl mx-auto w-full px-6 py-6 flex justify-between items-center text-[11px] text-gray-400 border-t border-gray-200 mt-12">
        <p>© 2026 Mabarin PlayStation Lounge Management</p>
        <p>System Rental v1.0</p>
    </footer>

</body>
</html>