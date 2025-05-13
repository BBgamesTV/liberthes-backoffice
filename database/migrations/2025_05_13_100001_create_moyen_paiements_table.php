<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('moyen_paiements', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // CB, espèces, Lydia...
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moyen_paiements');
    }
};


