@extends('layout.admin.layout')
@section('title', 'Manajemen Akun')

@section('content')

    <div class="p-6 bg-gray-50 min-h-screen space-y-6">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Akun Pengguna</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola akses dan hak istimewa administrator.</p>
            </div>
            <a href="{{ route('dashboard.admin.akun.create') }}"
               class="flex items-center gap-2 bg-amber-700 hover:bg-amber-800 text-white px-5 py-2.5 rounded-xl font-semibold shadow-lg shadow-amber-900/20 transition-all hover:-translate-y-0.5">
                <i class="fa-solid fa-user-plus"></i>
                <span>Buat Akun</span>
            </a>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            
            <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row justify-between items-center gap-4">
                <form action="{{ route('dashboard.admin.akun.view') }}" method="GET" class="relative w-full sm:max-w-md">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           class="w-full pl-11 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all shadow-sm"
                           placeholder="Cari nama atau email pengguna..."
                    >
                </form>

                @if(request('search'))
                    <a href="{{ route('dashboard.admin.akun.view') }}" class="text-sm text-red-500 hover:text-red-700 font-medium hover:underline flex items-center gap-1">
                        <i class="fa-solid fa-times-circle"></i> Reset Filter
                    </a>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                            <th class="px-6 py-4 w-16 text-center">#</th>
                            <th class="px-6 py-4">Pengguna</th>
                            <th class="px-6 py-4">Role / Peran</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($users as $index => $user)
                            <tr class="group hover:bg-amber-50/30 transition-colors duration-200">
                                <td class="px-6 py-4 text-center text-gray-400 font-medium text-sm">
                                    {{ $users->firstItem() + $index }}
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 border border-gray-300 text-gray-600 flex items-center justify-center font-bold text-sm shadow-sm">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900 group-hover:text-amber-700 transition-colors">
                                                {{ $user->name }}
                                            </div>
                                            <div class="text-xs text-gray-500 font-mono mt-0.5">
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    @if(strtolower($user->role) === 'admin')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-amber-100 text-amber-800 border border-amber-200">
                                            <i class="fa-solid fa-shield-halved text-[10px]"></i>
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-gray-100 text-gray-600 border border-gray-200">
                                            <i class="fa-solid fa-user text-[10px]"></i>
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Aktif
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <a href="{{ route('dashboard.admin.akun.edit', $user->id) }}"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-500 hover:text-blue-600 hover:border-blue-300 transition-all shadow-sm"
                                           title="Edit Akun">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </a>
                                        
                                        <form class="deleteForm inline" action="{{ route('dashboard.admin.akun.delete', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-500 hover:text-red-600 hover:border-red-300 transition-all shadow-sm"
                                                    title="Hapus Akun">
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="sm:hidden flex justify-end gap-2">
                                         {{-- Buttons visible on mobile --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mb-4">
                                            <i class="fa-solid fa-users-slash text-2xl"></i>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900">Tidak ada akun ditemukan</h3>
                                        <p class="text-sm text-gray-500 mt-1 max-w-sm">
                                            Sesuaikan pencarian Anda atau tambahkan akun administrator baru.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-gray-500">
                        Menampilkan <span class="font-medium">{{ $users->firstItem() }}</span> - <span class="font-medium">{{ $users->lastItem() }}</span> dari <span class="font-medium">{{ $users->total() }}</span> akun
                    </div>
                    <div>
                        {{ $users->appends(request()->query())->links('pagination::tailwind') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('submit', function (e) {
            if (e.target.classList.contains('deleteForm')) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus Akun?',
                    text: "Akses pengguna ini akan dicabut permanen.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-2xl'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.target.submit();
                    }
                });
            }
        });
    </script>

@endsection