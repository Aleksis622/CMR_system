<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->string('inspection_id')->unique();
            $table->string('case_id')->nullable();
            $table->string('type')->nullable();
            $table->string('requested_by')->nullable();
            $table->timestamp('start_ts')->nullable();
            $table->string('location')->nullable();
            $table->json('checks')->nullable();
            $table->string('assigned_to')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
