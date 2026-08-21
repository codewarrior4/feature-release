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
        Schema::create('feature_events', function (Blueprint $table) {
            $table->id();
            $table->string('feature');
            $table->string('scope');
            $table->string('action');
            $table->text('value')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['feature', 'created_at']);
            $table->index(['scope', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_events');
    }
};
