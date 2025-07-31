<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaction_per_months_event_sourcing', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_month');
            $table->year('transaction_year');
            $table->integer('total')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_per_months_event_sourcing');
    }
};
