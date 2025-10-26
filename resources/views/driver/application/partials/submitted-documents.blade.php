@if($application->documents->count() > 0)
<!-- Submitted Documents -->
<div class="bg-white rounded-xl shadow-lg p-6" id="submitted-documents">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Submitted Documents</h2>

    <div class="space-y-4">
        @foreach($application->documents->groupBy(function($doc) {
            return match($doc->document_type) {
                'id_picture', 'cedula' => 'Personal Documents',
                'lto_certificate', 'lto_receipt' => 'LTO Documents',
                'engine_stencil', 'chassis_stencil' => 'Vehicle ID Numbers',
                'tricycle_front', 'tricycle_side', 'tricycle_back' => 'Tricycle Photos',
            };
        }) as $category => $docs)
            <div class="border-b last:border-b-0 pb-6 last:pb-0">
                <h3 class="font-bold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-folder text-blue-500 mr-2"></i>
                    {{ $category }}
                </h3>
                <div class="space-y-2 ml-6">
                    @foreach($docs as $doc)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <i class="fas {{ $doc->document_icon }} text-gray-600"></i>
                                <div>
                                    <p class="font-semibold text-gray-800 text-sm">{{ $doc->document_label }}</p>
                                    <p class="text-xs text-gray-500">{{ $doc->file_name }} • {{ number_format($doc->file_size / 1024, 1) }} KB</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $doc->status === 'approved' ? 'bg-green-100 text-green-800' : ($doc->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    @if($doc->status === 'approved')
                                        <i class="fas fa-check-circle mr-1"></i>Approved
                                    @elseif($doc->status === 'rejected')
                                        <i class="fas fa-times-circle mr-1"></i>Rejected
                                    @else
                                        <i class="fas fa-clock mr-1"></i>Pending
                                    @endif
                                </span>
                                @if($doc->isImage())
                                    <a href="{{ route('driver.application.document.view', [$application, $doc]) }}" target="_blank" class="text-blue-600 hover:text-blue-700 text-sm font-semibold" title="View image">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endif
                                <a href="{{ route('driver.application.document.download', [$application, $doc]) }}" class="text-green-600 hover:text-green-700 text-sm font-semibold" title="Download file">
                                    <i class="fas fa-download"></i>
                                </a>
                                @if($doc->status === 'rejected' && in_array($application->status, ['incomplete', 'pending_review']))
                                    <button type="button" onclick="openReuploadModal({{ $doc->id }}, '{{ $doc->document_type }}')" class="text-orange-600 hover:text-orange-700 text-sm font-semibold" title="Re-upload document">
                                        <i class="fas fa-redo"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                        @if($doc->status === 'rejected' && $doc->rejection_reason)
                            <div class="ml-9 bg-red-50 border border-red-200 p-3 rounded text-sm text-red-700 mb-2">
                                <strong>Rejection Reason:</strong> {{ $doc->rejection_reason }}
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

@include('driver.application.partials.reupload-modal')
@include('driver.application.partials.modals')
@endif
