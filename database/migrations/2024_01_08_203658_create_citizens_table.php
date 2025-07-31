<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citizens_async', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->string('community');
            $table->string('user_id');
            $table->integer('total')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citizens_async');
    }
};
