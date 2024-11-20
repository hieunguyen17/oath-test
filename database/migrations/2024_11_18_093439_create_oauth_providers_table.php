<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('oauth_providers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('provider_name');
            $table->string('provider_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oauth_providers');
    }
};
