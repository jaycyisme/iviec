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
        Schema::create('recruitment_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity_needed');
            $table->integer('quantity_recruited');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('status_id');
            $table->date('expired_date');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruitment_requirements');
    }
};
