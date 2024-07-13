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
        Schema::create('shift_problems', function (Blueprint $table) {
            $table->id();
            $table->text('note');
            $table->dateTime('start_date_time');
            $table->dateTime('end_date_time');
            $table->json('all_places')->default('{}');
            $table->json('all_employees')->default('{}');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_problems');
    }
};
