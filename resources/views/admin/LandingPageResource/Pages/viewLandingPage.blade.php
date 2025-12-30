@extends('layout.admin.layout')
@section('title', 'Landing Page Editor')

@section('content')
    <div x-data="{ 
            open: 'hero', 
            showPreview: false,
            togglePreview() {
                this.showPreview = !this.showPreview;
                document.body.style.overflow = this.showPreview ? 'hidden' : '';
            } }" class="flex flex-col lg:flex-row h-[calc(100dvh-64px)] lg:overflow-hidden bg-gray-100 relative">

        <div class="w-full lg:w-1/2 flex flex-col h-full border-r border-gray-200 bg-white shadow-xl z-10">

            <div class="flex-none p-4 sm:p-6 border-b border-gray-100 bg-white z-20 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">Page Editor</h1>
                    <p class="text-gray-500 text-xs sm:text-sm mt-1">Manage your landing page content</p>
                </div>

                <div class="hidden lg:block text-xs text-gray-400 font-mono">
                    <i class="fa-solid fa-desktop mr-1"></i> Desktop Mode
                </div>
            </div>

            <div
                class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-4 bg-gray-50/50 pb-24 lg:pb-6 scrollbar-thin scrollbar-thumb-gray-300">

                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                        class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg shadow-sm text-sm">
                        <i class="fa-solid fa-circle-check"></i>
                        <span class="font-medium">Changes saved successfully.</span>
                    </div>
                @endif

                @php
                    $sectionsList = [
                        'hero' => ['label' => 'Hero Section', 'icon' => 'fa-star'],
                        'about' => ['label' => 'Tentang Brownita', 'icon' => 'fa-info-circle'],
                        'founder' => ['label' => 'Profil Founder', 'icon' => 'fa-user-tie'],
                    ];
                @endphp

                @foreach ($sectionsList as $key => $meta)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 transition-all duration-200"
                        :class="open === '{{ $key }}' ? 'ring-2 ring-amber-500/20 border-amber-500' : 'hover:border-amber-300'">

                        <button @click="open === '{{ $key }}' ? open = null : open = '{{ $key }}'"
                            class="w-full flex justify-between items-center px-4 py-3 sm:px-5 sm:py-4 text-left group">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center group-hover:bg-amber-100 transition-colors">
                                    <i class="fa-solid {{ $meta['icon'] }} text-sm"></i>
                                </div>
                                <span
                                    class="font-semibold text-gray-700 group-hover:text-gray-900 text-sm sm:text-base">{{ $meta['label'] }}</span>
                            </div>
                            <i class="fa-solid fa-chevron-down text-gray-400 transition-transform duration-200"
                                :class="open === '{{ $key }}' ? 'rotate-180 text-amber-600' : ''"></i>
                        </button>

                        <div x-show="open === '{{ $key }}'" x-collapse class="border-t border-gray-100 bg-gray-50/30">
                            <form method="POST" action="{{ route('dashboard.admin.landing-page.update', $key) }}"
                                enctype="multipart/form-data" class="p-4 sm:p-5 space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Main
                                        Title</label>
                                    <input type="text" name="content[title]"
                                        value="{{ $sections[$key]->content['title'] ?? '' }}"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none text-sm placeholder-gray-400">
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Description</label>
                                    <textarea name="content[desc]" rows="4"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none text-sm placeholder-gray-400 resize-none">{{ $sections[$key]->content['desc'] ?? '' }}</textarea>
                                </div>
                                <div class="flex justify-end pt-2">
                                    <button type="submit"
                                        class="bg-amber-700 hover:bg-amber-800 text-white px-5 py-2 rounded-lg text-sm font-semibold shadow-md flex items-center gap-2">
                                        <i class="fa-solid fa-save"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="lg:w-1/2 bg-gray-200/50 flex flex-col transition-none" :class="showPreview 
                ? 'fixed inset-0 z-[60] bg-gray-900/40 backdrop-blur-sm h-[100dvh] w-full p-0 flex' 
                : 'hidden lg:flex h-full lg:p-8 relative'">
            <div
                class="flex justify-between items-center p-4 bg-gray-600/30 backdrop-blur-md text-white lg:hidden flex-none">
                <h2 class="font-bold text-lg flex items-center gap-2">
                    <i class="fa-solid fa-mobile-screen"></i>
                    Live Preview
                </h2>
                <button @click="togglePreview()"
                    class="bg-white/10 hover:bg-white/20 w-8 h-8 rounded-full flex items-center justify-center transition">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>

            <div class="flex-1 w-full h-full flex flex-col items-center justify-center p-4 lg:p-0 overflow-hidden">
                <div
                    class="bg-white shadow-2xl rounded-xl overflow-hidden border border-gray-300 w-full h-full max-w-md lg:max-w-[90%] lg:max-h-[90%] flex flex-col">
                    <div class="bg-gray-100 border-b p-2 flex items-center gap-2 flex-none">
                        <div class="flex gap-1.5 ml-2">
                            <div class="w-2.5 h-2.5 rounded-full bg-red-400"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-yellow-400"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-green-400"></div>
                        </div>
                        <div
                            class="flex-1 bg-white rounded-md h-6 mx-3 text-[10px] flex items-center px-2 text-gray-400 truncate">
                            {{ url('/') }}
                        </div>
                    </div>

                    <iframe id="preview" src="{{ route('dashboard.admin.landing-page.preview') }}"
                        class="w-full flex-1 bg-white border-0"></iframe>
                </div>

                <div class="mt-4 text-gray-400 text-xs font-mono hidden lg:block">
                    Live Preview
                </div>
            </div>
        </div>

        <button @click="togglePreview()"
            class="lg:hidden fixed bottom-6 right-6 z-40 bg-amber-700 text-white w-14 h-14 rounded-full shadow-lg shadow-amber-900/40 flex items-center justify-center hover:bg-amber-800 transition-transform active:scale-95"
            x-show="!showPreview" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">
            <i class="fa-solid fa-eye text-xl"></i>
        </button>

    </div>

    @if(session('reloadPreview'))
        <script>
            document.getElementById('preview')?.contentWindow.location.reload();
        </script>
    @endif
@endsection