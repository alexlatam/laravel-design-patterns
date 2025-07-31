<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citizens_event_sourcing', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid'); // id de los eventos que se van a ir creando
            $table->string('community');
            $table->string('user_id');
            $table->integer('total')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citizens_event_sourcing');
    }
};
