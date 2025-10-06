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
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('inspections', function (Blueprint $table) {
            $table->enum('status', [
                'scheduled',           // Inspection scheduled, waiting for inspector
                'pending',            // Inspection in progress/pending completion
                'completed',          // Inspection completed
                'failed',             // Vehicle failed inspection
                'cancelled'           // Inspection cancelled
            ])->default('scheduled')->after('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('inspections', function (Blueprint $table) {
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled')->after('location');
        });
    }
};
