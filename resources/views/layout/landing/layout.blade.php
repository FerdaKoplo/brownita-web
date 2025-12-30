<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/brownitaLogo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/brownitaLogo.png') }}">
    <meta property="og:image" content="{{ asset('images/brownitaLogo.png') }}">
    <title>BROWNITA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white">

    @auth
        @include('components.customer.logged-in.nav')
    @else
        @include('components.customer.logged-out.nav')
    @endauth

    <main>
        @yield('content')
    </main>

    <x-reusable.floating-button-whatsapp />

</body>

</html>