<?php

use App\Models\Employee;
use App\Models\Place;
use App\Models\Shift;
use App\Models\ShiftProblem;
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
        Schema::create('spots', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ShiftProblem::class);
            $table->foreignIdFor(Place::class);
            $table->foreignIdFor(Shift::class);
            $table->dateTime('start_date_time');//so a spot is only for a day, needed for availablity and absences
            $table->foreignIdFor(Employee::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spots');
    }
};
