<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('🎬 Daftar Video & Status Akses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error') || session('warning'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') ?? session('warning') }}</span>
                </div>
            @endif
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Video yang Tersedia</h3>

                    
                    @forelse ($videos as $video)
                        @php
                            $request_status = $user_requests->get($video->id);
                        @endphp

                        <div class="border p-4 mb-4 rounded shadow-md flex justify-between items-center transition duration-150 ease-in-out hover:bg-gray-50">
                            
                            <div class="flex items-start space-x-4"> 
                                
                               
                                <div class="flex-shrink-0 w-32 h-20 overflow-hidden rounded-md">
                                    
                                    <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/mqdefault.jpg" 
                                        alt="Thumbnail: {{ $video->title }}" 
                                        class="w-full h-full object-cover">
                                </div>

                                <div>
                                    <h4 class="text-xl font-semibold">{{ $video->title }}</h4>
                                    <p class="text-sm text-gray-600 hidden sm:block">ID YouTube: {{ $video->youtube_id }}</p>
                                    
                                    <p class="mt-2 text-sm font-bold">Status Akses:
                                        @if ($request_status && $request_status->status == 'approved' && now()->lessThan($request_status->approved_until))
                                            <span class="text-green-600">Disetujui! (Berakhir: {{ $request_status->approved_until->format('d M Y') }})</span>
                                        @elseif ($request_status && $request_status->status == 'pending')
                                            <span class="text-yellow-600">Menunggu Persetujuan Admin.</span>
                                        @elseif ($request_status && $request_status->status == 'rejected')
                                            <span class="text-red-600">Ditolak.</span>
                                        @else
                                            <span class="text-gray-500">Belum diajukan.</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="flex-shrink-0">
                                
                                @if ($request_status && $request_status->status == 'approved' && now()->lessThan($request_status->approved_until))
                                    <a href="{{ route('customer.watch', $video) }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-150">
                                        Tonton Sekarang
                                    </a>
                                @else
                                    <form method="POST" action="{{ route('customer.request.store', $video) }}">
                                        @csrf
                                        <button type="submit" 
                                            @if ($request_status && ($request_status->status == 'pending'))
                                                disabled class="bg-gray-400 py-2 px-4 rounded cursor-not-allowed"
                                            @else
                                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150"
                                            @endif
                                        >
                                            @if ($request_status && $request_status->status == 'rejected')
                                                Ajukan Ulang
                                            @else
                                                Minta Akses
                                            @endif
                                        </button>
                                    </form>
                                @endif
                            </div>

                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada video yang ditambahkan oleh Admin.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>