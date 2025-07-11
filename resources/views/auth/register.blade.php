<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Kameron&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


    @vite('resources/css/app.css')
</head>

<body>

    @if (Auth::check())
        @include('components.customer.logged-in.nav')
    @else
        @include('components.customer.logged-out.nav')
    @endif
<<<<<<< HEAD
=======

>>>>>>> 03e4e8a (fix message error & fitur hps gambar)
    <div class="min-h-screen flex flex-col bg-brand-light  justify-center gap-12 items-center">
        <div class="flex">
            <h1
                class="bg-brand-secondary items-center rounded-l-2xl flex p-5 text-brand-light font-kameron font-bold text-5xl">
                BROWNITA</h1>
            <form method="POST" action="{{ route('register.post') }}"
                class="bg-brand-lightdark p-5 rounded-r-3xl flex text-2xl flex-col gap-8">
                @csrf
                <h1 class="text-3xl font-bold">Register</h1>

                {{-- Username --}}
                <div class="flex flex-col text-lg items-start gap-2 w-full">
                    <p class="font-medium">Username</p>
                    <input type="text" class="bg-brand-secondary rounded-lg text-brand-light w-full px-4 py-2 
            @error('name') border border-red-500 @enderror" name="name" id="name" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="flex flex-col text-lg items-start gap-2 w-full">
                    <p class="font-medium">Email</p>
                    <input type="text" class="bg-brand-secondary rounded-lg text-brand-light w-full px-4 py-2 
            @error('email') border border-red-500 @enderror" name="email" id="email" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="flex flex-col text-lg items-start gap-2 w-full">
                    <p class="font-medium">Password</p>
                    <div class="flex gap-4 w-full">
                        <input type="password" class="bg-brand-secondary rounded-lg text-brand-light w-full px-4 py-2 
                @error('password') border border-red-500 @enderror" name="password" id="password">
                        <button class="" type="button">
                            <i class="fa-solid fa-eye" id="toggle-password"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="flex flex-col text-lg items-start gap-2 w-full">
                    <p class="font-medium">Confirm Password</p>
                    <div class="flex gap-4 w-full">
                        <input type="password" class="bg-brand-secondary rounded-lg text-brand-light w-full px-4 py-2"
                            name="password_confirmation" id="password_confirmation">
                        <button class="" type="button">
                            <i class="fa-solid fa-eye" id="toggle-password-confirmation"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="bg-brand-dark rounded-lg text-lg text-brand-light p-2">
                    Register
                </button>
            </form>

        </div>
        <div>
            <p>Sudah Punya Akun?
                <a href="{{ route('login') }}" class="font-bold">
                    Login Disini!
                </a>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif

    <script src="{{ asset('js/PasswordVisibility.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

</body>

</html>