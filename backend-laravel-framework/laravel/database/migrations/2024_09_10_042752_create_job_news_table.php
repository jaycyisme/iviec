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
        Schema::create('job_news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('candidate_quantity');
            $table->unsignedBigInteger('recruitment_requirement_id');
            $table->unsignedBigInteger('status_id');
            $table->string('job');
            $table->string('position');
            $table->string('job_description');
            $table->string('requirement');
            $table->string('benefit');
            $table->string('working_form');
            $table->string('level');
            $table->unsignedBigInteger('salary_type_id');
            $table->double('salary_start')->nullable();
            $table->double('salary_end')->nullable();
            $table->integer('year_of_experience')->nullable();
            $table->string('gender')->nullable();
            $table->string('language')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('recruitment_requirement_id')->references('id')->on('recruitment_requirements')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
            $table->foreign('salary_type_id')->references('id')->on('salary_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_news');
    }
};
