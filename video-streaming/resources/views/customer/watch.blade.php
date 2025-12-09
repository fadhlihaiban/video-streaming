<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('▶️ Menonton: ' . $video->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-3xl font-bold mb-4">{{ $video->title }}</h1>

                    <div class="relative" style="padding-bottom: 56.25%;"> 
                        <iframe 
                            class="absolute top-0 left-0 w-full h-full"
                            src="https://www.youtube.com/embed/{{ $video->youtube_id }}" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                    
                    <p class="mt-6 text-gray-600">Video ini disediakan secara eksklusif untuk pengguna yang telah disetujui aksesnya.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>