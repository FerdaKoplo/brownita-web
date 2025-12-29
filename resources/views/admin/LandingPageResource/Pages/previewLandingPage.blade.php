<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Landing Page Preview</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-white">

    @php
        $sections = Cache::rememberForever('landing_sections', function () {
            return \App\Models\LandingPage::all()
                ->keyBy('section_key')
                ->map(fn($s) => $s->content);
        });
    @endphp

    @include('landing.sections.hero', [
        'data' => $sections['hero'] ?? []
    ])

    @include('landing.sections.about', [
        'data' => $sections['about'] ?? []
    ])

    @include('landing.sections.founder', [
        'data' => $sections['founder'] ?? []
    ])

    {{-- @include('landing.sections.location', [
        'data' => $sections['location'] ?? []
    ]) --}}

</body>
</html>
