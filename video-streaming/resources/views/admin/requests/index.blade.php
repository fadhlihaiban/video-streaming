<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('👑 Manajemen Permintaan Video') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-xl font-bold mb-4">Daftar Permintaan Masuk</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Video Diminta</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                {{-- Pastikan variabel yang diterima dari Controller bernama $requests --}}
                                @forelse ($requests as $request)
                                    <tr>
                                        {{-- Mengakses relasi user yang meminta --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $request->user->name }}
                                        </td>
                                        
                                        {{-- Mengakses relasi video yang diminta --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $request->video->title }}
                                        </td>
                                        
                                        {{-- Tampilan Status --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if ($request->status == 'approved')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Disetujui (Sampai: {{ optional($request->approved_until)->format('d M Y') }})
                                                </span>
                                            @elseif ($request->status == 'rejected')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Ditolak
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            {{-- Baris 51 (tempat error Anda sebelumnya) adalah sekitar area ini --}}
                                            @if ($request->status == 'pending')
                                                
                                                <form method="POST" action="{{ route('admin.requests.approve', $request) }}" class="inline-block">
                                                    @csrf
                                                    <button type="submit" class="text-green-600 hover:text-green-900 mr-2">Setujui</button>
                                                </form>
                                                
                                                <form method="POST" action="{{ route('admin.requests.reject', $request) }}" class="inline-block" onsubmit="return confirm('Anda yakin menolak permintaan ini?');">
                                                    @csrf
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Tolak</button>
                                                </form>

                                            @else
                                                <span class="text-gray-500">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            Tidak ada permintaan video yang menunggu persetujuan.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>