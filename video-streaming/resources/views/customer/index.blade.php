<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Video & Status Akses Anda
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert"> {{ session('success') }} </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert"> {{ session('error') }} </div>
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                @foreach ($videos as $video)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-xl font-bold mb-3">{{ $video->title }}</h3>

                    @php
                        $request = $user_requests->get($video->id);
                        $access_granted = false;
                        $time_expired = false;
                        $status = 'Belum Diminta';

                        if ($request) {
                            $status = ucfirst($request->status);
                            
                            if ($request->status == 'approved') {
                                // Cek apakah waktu kedaluwarsa sudah lewat
                                if (\Carbon\Carbon::now()->lt($request->approved_until)) {
                                    $access_granted = true;
                                    $remaining_time = $request->approved_until->diffForHumans(\Carbon\Carbon::now(), ['parts' => 2, 'join' => ', ', 'syntax' => 'passthrough']);
                                } else {
                                    $time_expired = true;
                                    $status = 'Kedaluwarsa';
                                }
                            }
                        }
                    @endphp

                    <p class="text-sm font-semibold mb-2">Status Anda: <span class="
                        @if ($access_granted) text-green-600 @elseif ($time_expired || $status == 'Rejected') text-red-600 @else text-yellow-600 @endif
                    ">{{ $status }}</span></p>

                    @if ($access_granted)
                        <p class="text-xs text-green-500 mb-2">Akses berlaku sisa {{ $remaining_time }}</p>
                        <iframe
                            width="100%"
                            height="250"
                            src="https://www.youtube.com/embed/{{ $video->youtube_id }}?modestbranding=1&rel=0"
                            frameborder="0"
                            allowfullscreen>
                        </iframe>
                    @elseif ($request && ($request->status == 'pending' || $time_expired))
                        @if ($status == 'Pending')
                            <p class="text-yellow-600">Permintaan Anda sedang diproses oleh Admin.</p>
                        @elseif ($time_expired)
                            <form action="{{ route('customer.request.store', $video) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-sm mt-3">
                                    Request Lagi (Waktu Habis)
                                </button>
                            </form>
                        @endif
                    @else
                        <form action="{{ route('customer.request.store', $video) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm mt-3">
                                Ajukan Permintaan Tonton
                            </button>
                        </form>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>