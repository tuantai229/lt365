@extends('user.layouts.app')

@section('title', 'Tài liệu đã tải')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm">
    <h1 class="text-2xl font-bold text-gray-900 border-b border-gray-200 pb-4 mb-6">Tài liệu đã tải</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tên tài liệu
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Thông tin
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Ngày tải
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Hành động</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($downloads as $download)
                    @if($download->document)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    {{-- You can add a document thumbnail here if available --}}
                                    <div class="h-10 w-10 rounded-md bg-gray-100 flex items-center justify-center">
                                        <i class="ri-file-text-line text-xl text-gray-500"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        <a href="{{ route('documents.show', ['slug' => $download->document->slug, 'id' => $download->document->id]) }}" class="hover:text-primary">
                                            {{ $download->document->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if($download->document->level)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $download->document->level->name }}
                                </span>
                            @endif
                            @if($download->document->subject)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                    {{ $download->document->subject->name }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $download->downloaded_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('documents.download', ['slug' => $download->document->slug, 'id' => $download->document->id]) }}" class="text-primary hover:text-primary/80">
                                Tải lại
                            </a>
                        </td>
                    </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            Bạn chưa tải tài liệu nào.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $downloads->links() }}
    </div>
</div>
@endsection
