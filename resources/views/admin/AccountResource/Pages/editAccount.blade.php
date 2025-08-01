@extends('layout.admin.layout')
@section('title', 'Edit Akun Admin')
@section('content')

<div class="flex gap-10 flex-col justify-center items-center min-h-screen">
    <h1 class="text-3xl font-bold text-brand-dark">Edit Akun Admin</h1>
    <div class="flex flex-col items-center max-w-md w-full">
        <div class="bg-brand-dark w-10/12 h-7 rounded-t-xl"></div>
        <form method="POST" id="akunAdminEditForm"
            class="flex flex-col gap-5 w-full rounded-xl bg-brand-lightdark p-5"
            action="{{ route('dashboard.admin.akun.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-2 font-semibold">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name"
                    value="{{ old('name', $user->name) }}"
                    class="bg-brand-secondary text-white py-2 px-4 w-full rounded-lg" required>
            </div>

            <div class="flex flex-col gap-2 font-semibold">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                    value="{{ old('email', $user->email) }}"
                    class="bg-brand-secondary text-white py-2 px-4 w-full rounded-lg" required>
            </div>

            <div class="flex flex-col gap-2 font-semibold">
                <label for="password">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                <input type="password" id="password" name="password"
                    class="bg-brand-secondary text-white py-2 px-4 w-full rounded-lg">
            </div>

            <div class="flex flex-col gap-2 font-semibold">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="bg-brand-secondary text-white py-2 px-4 w-full rounded-lg">
            </div>

            <div class="flex justify-center items-center gap-5">
                <button type="submit"
                    class="bg-brand-dark font-semibold px-5 py-1 text-brand-light rounded-xl">Simpan</button>
                <a class="px-5 py-1 bg-black text-brand-light rounded-xl font-semibold"
                    href="{{ route('dashboard.admin.akun.view') }}">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('akunAdminEditForm').addEventListener('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Yakin ingin menyimpan perubahan?',
            text: "Perubahan tidak bisa dibatalkan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        });
    });
</script>

@endsection
