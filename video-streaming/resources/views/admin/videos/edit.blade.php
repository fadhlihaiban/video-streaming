<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('✏️ Edit Video: ' . $video->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('admin.videos.update', $video) }}">
                        @csrf
                        @method('PATCH') 

                        <div class="mb-4">
                            <label for="title" class="block font-medium text-sm text-gray-700">Judul Video</label>

                            <input id="title" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="title" value="{{ old('title', $video->title) }}" required autofocus />
                            @error('title')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="youtube_id" class="block font-medium text-sm text-gray-700">ID YouTube (Contoh: dQw4w9WgXcQ)</label>

                            <input id="youtube_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="youtube_id" value="{{ old('youtube_id', $video->youtube_id) }}" required />
                            <p class="text-xs text-gray-500 mt-1">Hanya masukkan kode unik dari URL YouTube, bukan link penuh.</p>
                            @error('youtube_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.videos.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                                Batal
                            </a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition duration-150">
                                Update Video
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>