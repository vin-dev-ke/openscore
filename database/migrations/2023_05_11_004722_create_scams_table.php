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
        Schema::create('scams', function (Blueprint $table) {
            $table->id();
            $table->string('contact');
            $table->string('payment')->nullable();
            $table->string('scammer_name')->nullable();
            $table->integer('amount')->nullable();
            $table->string('scam_activity')->nullable();
            $table->string('platform')->nullable();
            $table->text('comments')->nullable();
            $table->string('country')->nullable();
            $table->unsignedBigInteger('file_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();

            // Foreign keys
            $table->foreign('file_id')->references('id')->on('files')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scams');
    }
};
