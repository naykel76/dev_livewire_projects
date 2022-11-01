<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique()->nullable();
            $table->longText('description')->nullable();
            $table->text('status'); // needs value will spit the dummy!
            $table->string('image')->nullable();
            $table->integer('sort_order')->nullable()->default(0);
            $table->string('client')->nullable();
            $table->string('published_at')->nullable();
            $table->string('date_started')->nullable();
            $table->string('date_completed')->nullable();
            $table->integer('project_value')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
