@extends('layout.landing.layout')

@section('content')

@php
    $sections = Cache::rememberForever('landing_sections', function () {
        return \App\Models\LandingPage::all()
            ->keyBy('section_key')
            ->map(fn ($s) => $s->content);
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

@include('landing.sections.location', [
    'data' => $sections['location'] ?? []
])
@endsection
