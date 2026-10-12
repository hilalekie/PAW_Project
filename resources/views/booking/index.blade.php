<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Booking - Mabarin Admin</title>
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
                    <a href="{{ route('pelanggan.index') }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">Pelanggan</a>
                    <a href="{{ route('ruangan.index') }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">Ruangan</a>
                    <a href="{{ route('booking.index') }}" class="px-3 py-2 rounded-lg bg-blue-50 text-blue-600 font-semibold">Booking</a>
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

            
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Data Booking</h1>
                    <p class="text-xs text-gray-500 mt-0.5">Kelola jadwal dan status transaksi penyewaan ruangan PlayStation.</p>
                </div>
                <a href="{{ route('booking.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-lg shadow-sm transition flex items-center gap-1.5">
                    <span>+ Tambah</span>
                </a>
            </div>

           
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/70 border-b border-gray-200 text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                                <th class="py-3.5 px-6 w-12 text-center">No</th>
                                <th class="py-3.5 px-6">Pelanggan</th>
                                <th class="py-3.5 px-6">Ruangan</th>
                                <th class="py-3.5 px-6">Tanggal</th>
                                <th class="py-3.5 px-6">Jam</th>
                                <th class="py-3.5 px-6">Durasi</th>
                                <th class="py-3.5 px-6">Total</th>
                                <th class="py-3.5 px-6 text-center">Status</th>
                                <th class="py-3.5 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-xs text-gray-700 font-medium">
                            @forelse($bookings as $index => $booking)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-4 px-6 text-center text-gray-400">{{ $index + 1 }}</td>
                                <td class="py-4 px-6 font-bold text-gray-900">
                                    {{ $booking->pelanggan->nama ?? '-' }}
                                    <div class="text-[10px] text-gray-400 font-normal">{{ $booking->pelanggan->no_hp ?? '' }}</div>
                                </td>
                                <td class="py-4 px-6 text-gray-700">{{ $booking->ruangan->nama_ruangan ?? '-' }}</td>
                                <td class="py-4 px-6 text-gray-600">{{ \Carbon\Carbon::parse($booking->tanggal)->format('Y-m-d') }}</td>
                                <td class="py-4 px-6 text-gray-600">{{ $booking->jam_mulai }}</td>
                                <td class="py-4 px-6 text-gray-600">{{ $booking->durasi }} jam</td>
                                <td class="py-4 px-6 font-bold text-gray-900">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                                <td class="py-4 px-6 text-center">
                                    @if($booking->status == 'dipesan')
                                        <span class="inline-block px-2.5 py-1 text-[10px] font-bold text-amber-700 bg-amber-50 border border-amber-200 rounded-full">Dipesan</span>
                                    @elseif($booking->status == 'selesai')
                                        <span class="inline-block px-2.5 py-1 text-[10px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-full">Selesai</span>
                                    @else
                                        <span class="inline-block px-2.5 py-1 text-[10px] font-bold text-rose-700 bg-rose-50 border border-rose-200 rounded-full">Batal</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('booking.edit', $booking->id) }}" class="px-2.5 py-1 bg-amber-500 hover:bg-amber-600 text-white rounded font-bold transition text-[10px]">Edit</a>
                                        <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data booking ini?');" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 bg-rose-500 hover:bg-rose-600 text-white rounded font-bold transition text-[10px]">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="py-12 px-6 text-center text-gray-400 italic">
                                    Belum ada data.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- FOOTER -->
    <footer class="max-w-7xl mx-auto w-full px-6 py-6 flex justify-between items-center text-[11px] text-gray-400 border-t border-gray-200 mt-12">
        <p>© 2026 Mabarin PlayStation Lounge Management</p>
        <p>System Rental v1.0</p>
    </footer>

</body>
</html>