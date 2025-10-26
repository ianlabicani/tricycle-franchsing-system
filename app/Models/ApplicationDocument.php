<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationDocument extends Model
{
    protected $fillable = [
        'application_id',
        'document_type',
        'file_name',
        'file_path',
        'mime_type',
        'file_size',
        'status',
        'rejection_reason',
    ];

    /**
     * Get the application this document belongs to.
     */
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    /**
     * Get a human-readable label for the document type.
     */
    public function getDocumentLabelAttribute(): string
    {
        return match ($this->document_type) {
            'id_picture' => '2x2 ID Picture',
            'lto_certificate' => 'LTO Certificate of Registration',
            'lto_receipt' => 'LTO Official Receipt',
            'cedula' => 'Cedula of Owner/Operator',
            'engine_stencil' => 'Engine Number Stencil',
            'chassis_stencil' => 'Chassis Number Stencil',
            'tricycle_front' => 'Tricycle Photo (Front)',
            'tricycle_side' => 'Tricycle Photo (Side)',
            'tricycle_back' => 'Tricycle Photo (Back)',
            default => ucfirst(str_replace('_', ' ', $this->document_type)),
        };
    }

    /**
     * Get icon for document type.
     */
    public function getDocumentIconAttribute(): string
    {
        return match ($this->document_type) {
            'id_picture', 'cedula' => 'fa-id-card',
            'lto_certificate', 'lto_receipt' => 'fa-file-pdf',
            'engine_stencil', 'chassis_stencil' => 'fa-stamp',
            'tricycle_front', 'tricycle_side', 'tricycle_back' => 'fa-image',
            default => 'fa-file',
        };
    }

    /**
     * Check if document is an image.
     */
    public function isImage(): bool
    {
        return in_array($this->mime_type, ['image/jpeg', 'image/png', 'image/webp']);
    }
}
