<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Drop the old status enum and create new one with complete lifecycle
            $table->dropColumn('status');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->enum('status', [
                'draft',
                'pending_review',      // Step 1: Submitted by driver, waiting for SB review
                'incomplete',          // Step 2: Missing requirements
                'for_scheduling',      // Step 2: Complete, ready for inspection scheduling
                'inspection_scheduled',// Step 3: Inspection date/time set
                'inspection_pending',  // Step 4: Waiting for inspection
                'inspection_failed',   // Step 4: Vehicle failed inspection
                'for_treasury',        // Step 5: Passed inspection, payment pending
                'for_approval',        // Step 6: Payment verified, awaiting SB approval
                'approved',            // Step 6: Application approved by SB
                'rejected',            // Step 6: Application rejected
                'released',            // Step 7: Documents released to driver
                'completed',           // Step 7: Process fully completed
                'for_renewal'          // Step 8: Due for renewal
            ])->default('draft')->after('purpose');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected'])->default('draft')->after('purpose');
        });
    }
};
