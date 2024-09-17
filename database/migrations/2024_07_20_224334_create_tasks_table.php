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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('range')->nullable();
            $table->integer('duration')->nullable();
            $table->date('date');
            $table->time('start');
            $table->integer('finish')->default(0);
            $table->integer('taken_time');
            $table->string('color')->default('#c0c0c0');
            $table->foreignId('plan_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
