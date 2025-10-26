<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For MySQL, we need to modify the enum to add the 'archived' status
        DB::statement("ALTER TABLE applications MODIFY status ENUM('draft', 'pending_review', 'incomplete', 'for_scheduling', 'inspection_scheduled', 'inspection_pending', 'inspection_failed', 'for_treasury', 'for_approval', 'approved', 'rejected', 'released', 'completed', 'for_renewal', 'archived') DEFAULT 'draft'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove 'archived' from the enum
        DB::statement("ALTER TABLE applications MODIFY status ENUM('draft', 'pending_review', 'incomplete', 'for_scheduling', 'inspection_scheduled', 'inspection_pending', 'inspection_failed', 'for_treasury', 'for_approval', 'approved', 'rejected', 'released', 'completed', 'for_renewal') DEFAULT 'draft'");
    }
};
