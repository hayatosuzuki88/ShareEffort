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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start'); // プランの開始日
            $table->date('end'); // プランの終了日
            $table->integer('duration')->nullable(); // 何分かかる予定か
            $table->integer('range_start')->nullable(); // タスク範囲の始め
            $table->integer('range_end')->nullable(); // タスク範囲の終わり
            $table->string('range_unit')->nullable(); // 範囲の単位（ページなど）
            $table->time('routine_time')->nullable(); // 何時に行うか
            $table->integer('interval'); // 何日ごとに実施するか
            $table->foreignId('goal_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
