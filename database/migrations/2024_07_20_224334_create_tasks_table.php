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
            $table->integer('duration')->nullable(); // 何分かかる予定か
            $table->date('date'); // 実施日
            $table->time('start')->nullable(); // 開始時間
            $table->integer('finish')->default(0); // 実施状況
            $table->integer('taken_time'); // かかった時間
            $table->string('color')->default('#c0c0c0'); // カレンダーで表示する色
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
