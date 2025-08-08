<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Kameron&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50">
    @if (Auth::check())
        @include('components.customer.logged-in.nav')
    @else
        @include('components.customer.logged-out.nav')
    @endif

    <div class="min-h-screen flex flex-col justify-center items-center gap-12 px-4 md:px-0 py-12">
        <div
            class="flex flex-col md:flex-row shadow-xl rounded-xl bg-white overflow-hidden max-w-4xl w-full md:h-96">

            <!-- Logo Section -->
            <div
                class="bg-amber-700 flex items-center justify-center p-6 md:p-10 md:w-1/2 rounded-t-xl md:rounded-l-xl md:rounded-tr-none">
                <img src="images/brownitaLogo.png" alt="Brownita Logo" class="h-48 md:h-56 rounded-xl bg-white" />
            </div>

            <!-- Form Section -->
            <form method="POST" action="{{ route('login.post') }}"
                class="flex flex-col justify-center gap-8 p-6 md:p-10 md:w-1/2 text-2xl"
                autocomplete="off">
                @csrf

                <h1 class="text-3xl font-bold text-gray-800">Login</h1>

                <div class="flex flex-col text-lg items-start gap-2">
                    <label for="email" class="font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" placeholder="Ketik email..."
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-700" />
                </div>

                <div class="flex flex-col text-lg items-start gap-2 relative">
                    <label for="password" class="font-medium text-gray-700">Password</label>
                    <div class="flex items-center gap-3 w-full">
                        <input type="password" id="password" name="password" placeholder="Ketik password..."
                            class="flex-grow px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-700" />
                        <button type="button" id="toggle-password" aria-label="Toggle Password Visibility"
                            class="text-gray-600 hover:text-amber-700 focus:outline-none">
                            <i class="fa-solid fa-eye-slash text-xl"></i>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="bg-amber-700 rounded-lg text-lg text-white hover:opacity-80 transition py-3 mt-4 w-full">
                    Login
                </button>
            </form>
        </div>

        <p class="text-center text-gray-700 text-lg">
            Belum Punya Akun?
            <a href="{{ route('register') }}" class="font-bold text-amber-700 hover:underline">
                Registrasi Sekarang!
            </a>
        </p>
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
    @elseif(session('fail'))
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
            const toggleButton = document.getElementById(toggleButtonId);
            const input = document.getElementById(inputId);

            toggleButton.addEventListener('click', (e) => {
                e.preventDefault();
                const icon = toggleButton.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });
        }

        setupPasswordToggle('password', 'toggle-password');
    </script>
</body>

</html>
