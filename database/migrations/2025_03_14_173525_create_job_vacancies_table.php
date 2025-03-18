<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
     {
         Schema::create('job_vacancies', function (Blueprint $table) {
             $table->id();
             $table->string('title');
             $table->text('description');
             $table->enum('type', ['CLT', 'CNPJ', 'Freelancer']);
             $table->boolean('paused')->default(false);
             $table->timestamps();
         });
     }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
