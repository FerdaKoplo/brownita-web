<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>BROWNITA</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-brand-light">
    @if (Auth::check())
        @include('components.customer.logged-in.nav')
    @else
        @include('components.customer.logged-out.nav')
    @endif

    <main class=" min-h-screen">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @vite('resources/css/app.css')
</head>
<body class="bg-brand-light">
    <main>

        @yield('content')
    </main>
</body>
</html>