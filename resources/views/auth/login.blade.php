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
    <div class="min-h-screen flex flex-col   justify-center gap-12 items-center">
        <div class="flex shadow-xl">
            <h1 class="bg-amber-700 items-center rounded-l-xl  flex p-5 text-white font-kameron font-bold text-5xl">
                BROWNITA</h1>
            <form method="POST" action="{{ route('login.post') }}"
                class="bg-white p-5  rounded-r-xl flex text-2xl flex-col gap-8">
                @csrf
                <h1 class="text-3xl font-bold">Login</h1>

                <div class="flex flex-col text-lg items-start gap-4">
                    <p class="font-medium">Email</p>
                    <input type="email" class=" px-4 py-1 rounded-lg " name="email" placeholder="Ketik email..."
                        id="email">
                </div>

                <div class="flex flex-col text-lg items-start gap-4">
                    <p class="font-medium">Password</p>
                    <div class="flex gap-5">
                        <input type="password" class=" px-4 py-1 rounded-lg "
                            name="password" id="password" placeholder="Ketik password...">
                        <button class="" id="toggle-password" type="button">
                            <i class="fa-solid fa-eye-slash" ></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="bg-amber-700 rounded-lg text-lg  text-white hover:opacity-80 transition p-1">
                    Login
                </button>
            </form>
        </div>
        <div>
            <p>Belum Punya Akun?
                <a href="{{ route('register') }}" class="font-bold">
                    Registrasi Sekarang!
                </a>
            </p>
        </div>
    </div>

    {{-- Sweetalert Popup --}}
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
    @elseif (session('fail'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: '{{ session('fail') }}',
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif

    {{-- Toggle Password --}}
    <script>
        function setupPasswordToggle(inputId, toggleButtonId) {
            const toggleButton = document.getElementById(toggleButtonId)
            const input = document.getElementById(inputId)

            toggleButton.addEventListener('click', (e) => {
                const icon = toggleButton.querySelector('i')

                const currentType = input.getAttribute('type')
                const newType = currentType === 'password' ? 'text' : 'password'
                input.setAttribute('type', newType)

                icon.classList.toggle('fa-eye-slash')
                icon.classList.toggle('fa-eye')

                e.preventDefault()
            })
        }

        setupPasswordToggle('password', 'toggle-password')
    </script>
</body>

</html>
