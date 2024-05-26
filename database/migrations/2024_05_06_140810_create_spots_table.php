<?php

use App\Models\Employee;
use App\Models\Place;
use App\Models\Shift;
use App\Models\ShiftProblem;
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
        Schema::create('spots', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ShiftProblem::class);
            $table->foreignIdFor(Place::class);
            $table->foreignIdFor(Shift::class);
            $table->foreignIdFor(Skill::class);//a spot can have only one skill, if we were to allow for more than one skill,
            //i.e. if we need an employee that has these two skill for a given spot, the place skill table needs to change as well,
            //for the moment composite skills can be added as a new skill, because we allow for employees to have multiple skills,
            //for eg. we have a male baker, as a composite skill, and have male and baker as skills as well (i.e. 3 skills in total)
            //so an employee can have these three skills, and some places need only a baker, others need a male baker
            $table->dateTime('start_date_time');//so a spot is only for a day, needed for availablity and absences
            $table->dateTime('end_date_time')->nullable();//from the shift this can be deduced but may be needed for quick access
            $table->foreignIdFor(Employee::class)->nullable();
            $table->timestamps();
            $table->softDeletes();
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
