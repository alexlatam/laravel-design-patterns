<?php

use App\Enums\ReviewStates;
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
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id');
            $table->enum('state', [ReviewStates::APPROVED->name, ReviewStates::REJECTED->name, ReviewStates::IN_PROGRESS->name]);
            $table->integer('score');
            $table->string('extra');
            $table->integer('id_error');
            $table->integer('auction');
            $table->integer('assignee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
