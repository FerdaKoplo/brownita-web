@extends('layout.admin.layout')
@section('title', 'Akun')
@section('content')

<div class="p-5 flex flex-col gap-10">
    <h1 class="text-3xl font-bold text-brand-dark">Akun Admin</h1>

    <div class="flex flex-col gap-3">
        <div class="flex w-full justify-between items-center">
            <form action="{{ route('dashboard.admin.akun.view') }}" method="GET"
                    class="max-w-md w-full flex  items-center gap-2 ">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="search" value="{{ request('search') }}" class="bg-brand-secondary appearance-none text-white w-full py-2 rounded-lg px-2"
                        placeholder="Cari Nama Akun...">
            </form>
            <div class="flex flex-row justify-end">
                <a class="bg-brand-dark text-brand-light p-2 rounded-lg font-semibold"
                    href="{{ route('dashboard.admin.akun.create') }}">
                    Buat Akun
                </a>
            </div>
        </div>

        <table class="table-auto w-full border-collapse">
            <thead class="bg-brand-secondary text-white">
                <tr>
                    <th class="text-left px-4 py-3">Nomor</th>
                    <th class="text-left px-4 py-3">Nama Pengguna</th>
                    <th class="text-left px-4 py-3">Email</th>
                    <th class="text-left px-4 py-3">Status Akun</th>
                    <th class="text-left px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-brand-lightdark">
                @forelse ($users as $index => $user)
                    <tr>
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2 capitalize">{{ $user->role }}</td>
                        <td class="px-4 py-2 flex items-center gap-3">
                            <a href="{{ route('dashboard.admin.akun.edit', $user->id) }}"
                                class="text-brand-dark  text-xl">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form class="deleteForm"
                                action="{{ route('dashboard.admin.akun.delete', $user->id) }}"
                                method="POST" onsubmit="return confirmDelete(event)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-brand-dark text-xl">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada akun admin.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmDelete(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Yakin ingin menghapus akun ini?',
            text: "Aksi ini tidak bisa dibatalkan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
            }
        });
    }
</script>

@endsection
