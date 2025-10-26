<!-- Submitted Requirements Section -->
<div class="bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Submitted Requirements</h2>

    @if($application->documents()->count() > 0)
        <div class="space-y-3">
            @foreach($application->documents as $document)
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-50 border-yellow-200',
                        'approved' => 'bg-green-50 border-green-200',
                        'rejected' => 'bg-red-50 border-red-200',
                    ];
                    $statusBgColor = $statusColors[$document->status] ?? 'bg-gray-50 border-gray-200';

                    $statusBadgeColors = [
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'approved' => 'bg-green-100 text-green-800',
                        'rejected' => 'bg-red-100 text-red-800',
                    ];
                    $statusBadgeColor = $statusBadgeColors[$document->status] ?? 'bg-gray-100 text-gray-800';
                @endphp
                <div class="flex items-start justify-between p-4 border rounded-lg {{ $statusBgColor }}" data-document-id="{{ $document->id }}">
                    <div class="flex items-start space-x-3 flex-1">
                        <div class="text-2xl mt-1">
                            @if(strpos($document->document_type, 'id') !== false || strpos($document->document_type, 'cedula') !== false)
                                <i class="fas fa-id-card text-blue-600"></i>
                            @elseif(strpos($document->document_type, 'image') !== false || strpos($document->document_type, 'photo') !== false)
                                <i class="fas fa-image text-purple-600"></i>
                            @else
                                <i class="fas fa-file-alt text-gray-600"></i>
                            @endif
                        </div>
                        <div>
                            <p class="font-bold text-gray-800">{{ ucfirst(str_replace('_', ' ', $document->document_type)) }}</p>
                            <p class="text-sm text-gray-600">Uploaded on {{ $document->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 ml-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusBadgeColor }}">
                            {{ ucfirst($document->status) }}
                        </span>
                        <button onclick="openDocumentViewModal({{ $document->id }}, '{{ $document->document_type }}', '{{ $document->status }}', '{{ $document->created_at->format('M d, Y') }}', '-')"
                            class="text-purple-600 hover:text-purple-700 font-semibold text-sm whitespace-nowrap px-3 py-1 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                            <i class="fas fa-eye mr-1"></i>View
                        </button>
                        <a href="{{ route('sb.documents.download', [$application, $document]) }}"
                            class="text-purple-600 hover:text-purple-700 font-semibold text-sm whitespace-nowrap px-3 py-1 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                            <i class="fas fa-download mr-1"></i>Download
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-8">
            <i class="fas fa-inbox text-gray-400 text-4xl mb-2"></i>
            <p class="text-gray-600">No documents submitted yet.</p>
        </div>
    @endif
</div>
