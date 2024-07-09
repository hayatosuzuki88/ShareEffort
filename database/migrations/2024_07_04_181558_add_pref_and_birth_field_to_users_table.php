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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('preference', 50)->nullable();   // 好みを記入し、カテゴライズ予定。とりあえず50文字。
            $table->date('birth');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            /*
            Schema::dropColumn('preference');
            Schema::dropColumn('birth');
            */
        });
    }
};
