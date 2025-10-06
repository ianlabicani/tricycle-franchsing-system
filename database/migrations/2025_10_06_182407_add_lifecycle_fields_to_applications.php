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
            // Queue number for inspection
            $table->string('queue_number')->nullable()->after('application_no');

            // Timestamp fields for lifecycle tracking
            $table->timestamp('reviewed_at')->nullable()->after('date_approved');
            $table->timestamp('scheduled_at')->nullable()->after('reviewed_at');
            $table->timestamp('inspected_at')->nullable()->after('scheduled_at');
            $table->timestamp('payment_verified_at')->nullable()->after('inspected_at');
            $table->timestamp('rejected_at')->nullable()->after('payment_verified_at');
            $table->timestamp('released_at')->nullable()->after('rejected_at');
            $table->timestamp('completed_at')->nullable()->after('released_at');

            // Renewal tracking
            $table->date('expiration_date')->nullable()->after('completed_at');
            $table->date('renewal_reminder_sent_at')->nullable()->after('expiration_date');

            // Actor tracking
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null')->after('user_id');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null')->after('reviewed_by');
            $table->foreignId('rejected_by')->nullable()->constrained('users')->onDelete('set null')->after('approved_by');
            $table->foreignId('released_by')->nullable()->constrained('users')->onDelete('set null')->after('rejected_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['reviewed_by']);
            $table->dropForeign(['approved_by']);
            $table->dropForeign(['rejected_by']);
            $table->dropForeign(['released_by']);

            $table->dropColumn([
                'queue_number',
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
                'released_by'
            ]);
        });
    }
};
