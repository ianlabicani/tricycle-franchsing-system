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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->onDelete('cascade');
            $table->date('scheduled_date');
            $table->time('scheduled_time');
            $table->string('inspector_name');
            $table->string('location');
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled');
            $table->enum('result', ['passed', 'failed'])->nullable();
            $table->text('notes')->nullable();
            $table->text('remarks')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->foreignId('scheduled_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('completed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('cancelled_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
