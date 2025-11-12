<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_id')->unique();
            $table->string('external_ref')->nullable();
            $table->string('status')->nullable();
            $table->string('priority')->nullable();
            $table->timestamp('arrival_ts')->nullable();
            $table->string('checkpoint_id')->nullable();
            $table->string('origin_country', 2)->nullable();
            $table->string('destination_country', 2)->nullable();
            $table->json('risk_flags')->nullable();
            $table->string('declarant_id')->nullable();
            $table->string('consignee_id')->nullable();
            $table->string('vehicle_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};
