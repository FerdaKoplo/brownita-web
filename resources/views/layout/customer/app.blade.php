<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>BROWNITA</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include('components.customer.header')

    <main>
        @yield('content')
    </main>
</body>
</html>
