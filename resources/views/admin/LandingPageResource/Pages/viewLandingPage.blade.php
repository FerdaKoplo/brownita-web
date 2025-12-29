@extends('layout.admin.layout')
@section('title', 'Landing Page Editor')

@section('content')
<div
    x-data="{ open: 'hero' }"
    class="grid grid-cols-1 lg:grid-cols-2 gap-6 min-h-screen bg-gray-50 p-4 sm:p-6"
>

    <div class="space-y-6 overflow-y-auto pr-2">

        <h1 class="text-2xl sm:text-4xl font-bold text-gray-800">
            Edit Landing Page
        </h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded">
                Changes saved & preview updated
            </div>
        @endif

        @php
            $sectionsList = [
                'hero' => 'Hero Section',
                'about' => 'Tentang Brownita',
                'founder' => 'Profil Founder',
                'location' => 'Lokasi',
            ];
        @endphp

        @foreach ($sectionsList as $key => $label)
        <div class="bg-white rounded-lg shadow border">

            <button
                @click="open === '{{ $key }}' ? open = null : open = '{{ $key }}'"
                class="w-full flex justify-between items-center px-6 py-4 font-semibold"
            >
                <span>{{ $label }}</span>
                <i class="fa-solid"
                   :class="open === '{{ $key }}' ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
            </button>

            <div x-show="open === '{{ $key }}'" x-transition class="px-6 py-6 border-t">

                <form
                    method="POST"
                    action="{{ route('dashboard.admin.landing-page.update', $key) }}"
                    class="space-y-4"
                >
                    @csrf

                    {{-- Title --}}
                    <div>
                        <label class="text-sm font-medium">Judul</label>
                        <input
                            type="text"
                            name="content[title]"
                            value="{{ $sections[$key]->content['title'] ?? '' }}"
                            class="border rounded px-3 py-2 w-full"
                        >
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="text-sm font-medium">Deskripsi</label>
                        <textarea
                            name="content[desc]"
                            rows="4"
                            class="border rounded px-3 py-2 w-full"
                        >{{ $sections[$key]->content['desc'] ?? '' }}</textarea>
                    </div>

                    {{-- Hero extras --}}
                    @if ($key === 'hero')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium">CTA WhatsApp</label>
                                <input
                                    type="text"
                                    name="content[cta_wa]"
                                    value="{{ $sections[$key]->content['cta_wa'] ?? '' }}"
                                    class="border rounded px-3 py-2 w-full"
                                >
                            </div>
                            <div>
                                <label class="text-sm font-medium">CTA Katalog</label>
                                <input
                                    type="text"
                                    name="content[cta_catalog]"
                                    value="{{ $sections[$key]->content['cta_catalog'] ?? '' }}"
                                    class="border rounded px-3 py-2 w-full"
                                >
                            </div>
                        </div>
                    @endif

                    {{-- Location --}}
                    @if ($key === 'location')
                        <div>
                            <label class="text-sm font-medium">Google Maps URL</label>
                            <input
                                type="text"
                                name="content[map_url]"
                                value="{{ $sections[$key]->content['map_url'] ?? '' }}"
                                class="border rounded px-3 py-2 w-full"
                            >
                        </div>
                    @endif

                    <div class="flex justify-end pt-4">
                        <button
                            class="bg-amber-700 hover:bg-orange-700 text-white px-6 py-2 rounded font-semibold">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
        @endforeach
    </div>

    <div class="hidden lg:block sticky top-0 h-screen border-l bg-white">
        <iframe
            id="preview"
            src="{{ route('landing.page') }}"
            class="w-full h-full"
        ></iframe>
    </div>

</div>

@if(session('reloadPreview'))
<script>
    document.getElementById('preview')?.contentWindow.location.reload();
</script>
@endif
@endsection
