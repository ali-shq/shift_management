<?php

use App\Models\Employee;
use App\Models\Place;
use App\Models\Shift;
use App\Models\Skill;
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
        Schema::create('employee_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class);
            $table->foreignIdFor(Place::class)->nullable();
            $table->foreignIdFor(Shift::class)->nullable();
            $table->foreignIdFor(Skill::class)->nullable();
            $table->integer('preference');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_preferences');
    }
};
