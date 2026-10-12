<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Mabarin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4 font-sans text-gray-800">

    <div class="bg-white w-full max-w-sm rounded-2xl shadow-xl p-8 border border-gray-100">
        
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-2 text-blue-600 mb-1">
                <!-- Ikon Gamepad (SVG Murni) -->
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a1 1 0 110-2 1 1 0 010 2zm-4 0a1 1 0 110-2 1 1 0 010 2zm-4 0a1 1 0 110-2 1 1 0 010 2z"></path>
                </svg>
                <h1 class="text-2xl font-bold tracking-tight">Mabarin</h1>
            </div>
            <p class="text-xs font-medium text-gray-500 uppercase tracking-widest">Login Admin</p>
        </div>

        @if($errors->any())
            <div class="mb-5 p-3 bg-red-50 text-red-600 text-sm rounded-lg border border-red-100 text-center font-medium">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                <input type="password" id="password" name="password" required placeholder="••••••••" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <button type="submit" class="w-full py-2.5 bg-blue-600 text-white text-sm font-bold rounded-lg hover:bg-blue-700 transition duration-200">
                Login
            </button>
        </form>

        <div class="mt-8">
            <a href="{{ route('ketersediaan') }}" class="flex items-center justify-between p-3.5 bg-gray-50 hover:bg-blue-50 border border-gray-100 rounded-xl transition group">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-1.5 rounded-md shadow-sm text-gray-400 group-hover:text-blue-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-700 group-hover:text-blue-700 transition">Area Pelanggan</p>
                        <p class="text-[10px] text-gray-500">Cek ketersediaan & booking jam</p>
                    </div>
                </div>
                <span class="text-xs font-bold text-blue-600 flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                    Buka <span aria-hidden="true">&rarr;</span>
                </span>
            </a>
        </div>

    </div>

</body>
</html>