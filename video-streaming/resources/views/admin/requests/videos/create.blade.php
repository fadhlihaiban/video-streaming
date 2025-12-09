<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ➕ Tambah Video Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('admin.videos.store') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">1. Judul Video</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" 
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" 
                               required>
                        @error('title') 
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> 
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="youtube_id" class="block text-gray-700 text-sm font-bold mb-2">2. YouTube ID</label>
                        <input type="text" name="youtube_id" id="youtube_id" value="{{ old('youtube_id') }}" 
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('youtube_id') border-red-500 @enderror" 
                               placeholder="Contoh: dQw4w9WgXcQ (bukan URL lengkap)" 
                               required>
                        <p class="text-gray-500 text-xs mt-1">Ambil kode unik di belakang 'v=' dari URL YouTube.</p>
                        @error('youtube_id') 
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> 
                        @enderror
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan Video
                        </button>
                        <a href="{{ route('admin.videos.index') }}" class="inline-block align-baseline font-bold text-sm text-indigo-600 hover:text-indigo-800">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>