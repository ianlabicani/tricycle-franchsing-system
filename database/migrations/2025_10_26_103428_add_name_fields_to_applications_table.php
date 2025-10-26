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
            // Add separated name fields
            $table->string('first_name')->nullable()->after('franchise_type');
            $table->string('middle_name')->nullable()->after('first_name');
            $table->string('last_name')->nullable()->after('middle_name');

            // Add queue number if not exists
            if (! Schema::hasColumn('applications', 'queue_number')) {
                $table->integer('queue_number')->nullable()->after('application_no');
            }

            // Add date_approved column
            $table->dateTime('date_approved')->nullable()->after('date_submitted');

            // Add additional fields for tracking
            $table->dateTime('reviewed_at')->nullable()->after('remarks');
            $table->dateTime('scheduled_at')->nullable()->after('reviewed_at');
            $table->dateTime('inspected_at')->nullable()->after('scheduled_at');
            $table->dateTime('payment_verified_at')->nullable()->after('inspected_at');
            $table->dateTime('rejected_at')->nullable()->after('payment_verified_at');
            $table->dateTime('released_at')->nullable()->after('rejected_at');
            $table->dateTime('completed_at')->nullable()->after('released_at');
            $table->date('expiration_date')->nullable()->after('completed_at');
            $table->dateTime('renewal_reminder_sent_at')->nullable()->after('expiration_date');

            // Add tracking fields for who made changes
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('rejected_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('released_by')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'middle_name',
                'last_name',
                'queue_number',
                'date_approved',
                'reviewed_at',
                'scheduled_at',
                'inspected_at',
                'payment_verified_at',
                'rejected_at',
                'released_at',
                'completed_at',
                'expiration_date',
                'renewal_reminder_sent_at',
                'reviewed_by',
                'approved_by',
                'rejected_by',
                'released_by',
            ]);
        });
    }
};
