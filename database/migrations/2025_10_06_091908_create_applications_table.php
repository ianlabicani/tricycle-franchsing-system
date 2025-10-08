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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('application_no')->unique();
            $table->enum('franchise_type', ['new', 'renewal', 'amendment']);

            // Personal Information
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->string('contact_number');
            $table->string('email');
            $table->text('address');

            // Vehicle Information
            $table->string('plate_number')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('chassis_number')->nullable();
            $table->integer('year_model')->nullable();
            $table->string('make')->nullable();
            $table->string('color')->nullable();

            // Route Information
            $table->string('route')->nullable();
            $table->string('operating_hours')->nullable();

            $table->text('purpose')->nullable();
            $table->enum('status', [
                'draft',
                'pending_review',      // Step 1: Submitted by driver, waiting for SB review
                'incomplete',          // Step 2: Missing requirements
                'for_scheduling',      // Step 2: Complete, ready for inspection scheduling
                'inspection_scheduled', // Step 3: Inspection date/time set
                'inspection_pending',  // Step 4: Waiting for inspection
                'inspection_failed',   // Step 4: Vehicle failed inspection
                'for_treasury',        // Step 5: Passed inspection, payment pending
                'for_approval',        // Step 6: Payment verified, awaiting SB approval
                'approved',            // Step 6: Application approved by SB
                'rejected',            // Step 6: Application rejected
                'released',            // Step 7: Documents released to driver
                'completed',           // Step 7: Process fully completed
                'for_renewal',          // Step 8: Due for renewal
            ])->default('draft');
            $table->text('remarks')->nullable();
            $table->dateTime('date_submitted')->nullable();
            $table->dateTime('date_completed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
