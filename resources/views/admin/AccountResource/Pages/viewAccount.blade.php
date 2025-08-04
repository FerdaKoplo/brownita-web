@extends('layout.admin.layout')
@section('title', 'Akun')
@section('content')

<div class="p-6 bg-gray-50 min-h-screen">
    <div class="flex flex-col gap-6">
        <div class="flex justify-between items-center">
            <h1 class="text-4xl font-bold text-gray-800">Akun Admin</h1>
            <a href="{{ route('dashboard.admin.akun.create') }}" class="bg-amber-700 hover:bg-orange-700 transition text-white px-4 py-2 rounded-lg font-medium">
                + Buat Akun
            </a>
        </div>

        <form action="{{ route('dashboard.admin.akun.view') }}" method="GET" class="max-w-md w-full flex items-center gap-3 bg-white p-3 rounded-lg shadow-md">
            <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
            <input type="text" name="search" value="{{ request('search') }}"
                class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400"
                placeholder="Cari Nama Akun...">
        </form>

        <div class="overflow-auto rounded-lg shadow-md">
            <table class="w-full text-left min-w-[800px]">
                <thead class="bg-black text-white">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Nama Pengguna</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Status Akun</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $index => $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3 capitalize">
                                <span class="inline-block px-2 py-1 text-xs rounded-full
                                    {{ $user->role == 'admin' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 space-x-2">
                                <a href="{{ route('dashboard.admin.akun.edit', $user->id) }}"
                                    class="text-blue-600 hover:text-blue-800 transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form class="inline deleteForm" action="{{ route('dashboard.admin.akun.delete', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-gray-500">Tidak ada akun admin.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Optional Pagination
        @if(method_exists($users, 'links'))
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @endif --}}
    </div>
</div>

<script>
    document.addEventListener('submit', function (e) {
        if (e.target.classList.contains('deleteForm')) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus akun ini?',
                text: "Data yang dihapus tidak bisa dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        }
    });
</script>

@endsection
