@extends('layout.admin.layout')
@section('title', 'Landing Page Editor')

@section('content')
{{-- Main Container: Fixed height to create an "App" feel --}}
<div 
    x-data="{ open: 'hero', showPreview: true }" 
    class="flex h-[calc(100vh-64px)] overflow-hidden bg-gray-100" 
>

    {{-- Left Panel: Editor Form --}}
    <div class="w-full lg:w-1/2 flex flex-col h-full border-r border-gray-200 bg-white shadow-xl z-10">
        
        {{-- Editor Header --}}
        <div class="flex-none p-6 border-b border-gray-100 bg-white z-20 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Page Editor</h1>
                <p class="text-gray-500 text-sm mt-1">Manage your landing page content</p>
            </div>
            
            {{-- Mobile Preview Toggle --}}
            <button @click="showPreview = !showPreview" class="lg:hidden text-gray-500 hover:text-amber-600">
                <i class="fa-solid fa-eye"></i>
            </button>
        </div>

        {{-- Scrollable Content Area --}}
        <div class="flex-1 overflow-y-auto p-6 space-y-6 bg-gray-50/50 scrollbar-thin scrollbar-thumb-gray-300">

            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
                     class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg shadow-sm">
                    <i class="fa-solid fa-circle-check"></i>
                    <span class="font-medium">Changes saved successfully.</span>
                </div>
            @endif

            @php
                $sectionsList = [
                    'hero' => ['label' => 'Hero Section', 'icon' => 'fa-star'],
                    'about' => ['label' => 'Tentang Brownita', 'icon' => 'fa-info-circle'],
                    'founder' => ['label' => 'Profil Founder', 'icon' => 'fa-user-tie'],
                    // 'location' => ['label' => 'Lokasi Store', 'icon' => 'fa-map-location-dot'],
                ];
            @endphp

            @foreach ($sectionsList as $key => $meta)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 transition-all duration-200"
                 :class="open === '{{ $key }}' ? 'ring-2 ring-amber-500/20 border-amber-500' : 'hover:border-amber-300'">

                {{-- Accordion Header --}}
                <button
                    @click="open === '{{ $key }}' ? open = null : open = '{{ $key }}'"
                    class="w-full flex justify-between items-center px-5 py-4 text-left group"
                >
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center group-hover:bg-amber-100 transition-colors">
                            <i class="fa-solid {{ $meta['icon'] }} text-sm"></i>
                        </div>
                        <span class="font-semibold text-gray-700 group-hover:text-gray-900">{{ $meta['label'] }}</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-gray-400 transition-transform duration-200"
                       :class="open === '{{ $key }}' ? 'rotate-180 text-amber-600' : ''"></i>
                </button>

                {{-- Accordion Body --}}
                <div x-show="open === '{{ $key }}'" 
                     x-collapse 
                     class="border-t border-gray-100 bg-gray-50/30">
                    
                    <form
                        method="POST"
                        action="{{ route('dashboard.admin.landing-page.update', $key) }}"
                        enctype="multipart/form-data" 
                        class="p-5 space-y-5"
                    >
                        @csrf

                        {{-- Common Fields --}}
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Main Title</label>
                                <input
                                    type="text"
                                    name="content[title]"
                                    value="{{ $sections[$key]->content['title'] ?? '' }}"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all shadow-sm outline-none"
                                    placeholder="Enter section title..."
                                >
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Description</label>
                                <textarea
                                    name="content[desc]"
                                    rows="4"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all shadow-sm outline-none resize-none"
                                    placeholder="Write your content here..."
                                >{{ $sections[$key]->content['desc'] ?? '' }}</textarea>
                            </div>
                        </div>

                        {{-- @if ($key === 'hero')
                            <div class="grid grid-cols-2 gap-4 pt-2 border-t border-gray-200 border-dashed">
                                <div class="col-span-2">
                                    <span class="text-xs font-bold text-amber-600 uppercase">Hero Specials</span>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700">Button Text</label>
                                    <input type="text" name="content[cta_text]" value="{{ $sections[$key]->content['cta_text'] ?? 'Order Now' }}" class="mt-1 w-full px-3 py-2 border rounded-md text-sm">
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700">WhatsApp Number</label>
                                    <input type="text" name="content[cta_wa]" value="{{ $sections[$key]->content['cta_wa'] ?? '' }}" class="mt-1 w-full px-3 py-2 border rounded-md text-sm">
                                </div>
                                <div class="col-span-2">
                                    <label class="text-sm font-medium text-gray-700">Background Image</label>
                                    <input type="file" name="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                                </div>
                            </div>
                        @endif --}}

                        {{-- @if ($key === 'founder')
                            <div class="pt-2 border-t border-gray-200 border-dashed">
                                <label class="text-sm font-medium text-gray-700">Founder Photo</label>
                                <div class="mt-2 flex items-center gap-4">
                                    @if(isset($sections[$key]->content['image']))
                                        <img src="{{ asset('storage/'.$sections[$key]->content['image']) }}" class="w-12 h-12 rounded-full object-cover border">
                                    @endif
                                    <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                                </div>
                            </div>
                        @endif --}}

                        {{-- Action Bar --}}
                        <div class="flex items-center justify-end gap-3 pt-4">
                            <button type="submit" class="bg-amber-700 hover:bg-amber-800 text-white px-6 py-2.5 rounded-lg text-sm font-semibold shadow-md shadow-amber-900/10 transition-all hover:-translate-y-0.5 flex items-center gap-2">
                                <i class="fa-solid fa-save"></i> Save {{ $meta['label'] }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
            
            {{-- Spacer for scrolling --}}
            <div class="h-10"></div>
        </div>
    </div>

    {{-- Right Panel: Live Preview --}}
    <div 
        class="hidden lg:block w-1/2 h-full bg-gray-200/50 p-8 relative"
        :class="{ 'hidden': !showPreview, 'fixed inset-0 z-50 bg-white p-0': window.innerWidth < 1024 && showPreview }"
    >
        {{-- Preview Device Frame --}}
        <div class="h-full flex flex-col items-center justify-center">
             <div class="bg-white shadow-2xl rounded-xl overflow-hidden border border-gray-300 w-full h-full max-w-[90%] max-h-[95%] flex flex-col">
                {{-- Fake Browser Bar --}}
                <div class="bg-gray-100 border-b p-3 flex items-center gap-2">
                    <div class="flex gap-1.5">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                        <div class="w-3 h-3 rounded-full bg-green-400"></div>
                    </div>
                    <div class="flex-1 bg-white rounded-md h-6 mx-4 text-xs flex items-center px-3 text-gray-400">
                        {{ url('/') }}
                    </div>
                </div>
                
                <iframe
                    id="preview"
                    src="{{ route('dashboard.admin.landing-page.preview') }}"
                    class="w-full flex-1 bg-white"
                ></iframe>
            </div>
            
            <div class="mt-4 text-gray-400 text-xs font-mono">
                Live Preview
            </div>
        </div>
        
        {{-- Close Preview Button (Mobile Only) --}}
        <button @click="showPreview = false" class="lg:hidden absolute top-4 right-4 bg-white p-2 rounded-full shadow-lg">
            <i class="fa-solid fa-times"></i>
        </button>
    </div>

</div>

@if(session('reloadPreview'))
<script>
    document.getElementById('preview')?.contentWindow.location.reload();
</script>
@endif
@endsection