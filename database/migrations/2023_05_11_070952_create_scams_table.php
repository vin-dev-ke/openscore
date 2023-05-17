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
<<<<<<< HEAD
<<<<<<< HEAD
            $table->text('content');
            $table->string('contact');
            $table->string('payment')->nullable();
            $table->unsignedBigInteger('file_id')->nullable();
            $table->foreign('file_id')
                ->references('id')
                ->on('files')
                ->onDelete('set null');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->softDeletes();
=======
            $table->string('content');
            $table->string('contact');
            $table->string('payment')->nullable();
            $table->unsignedBigInteger('file_id')->nullable();
            $table->foreign('file_id')->references('id')->on('files')->onDelete('set null');
>>>>>>> 4494bb2 (Add users and scams sections for admin)
=======
            $table->text('content');
            $table->string('contact');
            $table->string('payment')->nullable();
            $table->unsignedBigInteger('file_id')->nullable();
            $table->foreign('file_id')
                ->references('id')
                ->on('files')
                ->onDelete('set null');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->softDeletes();
>>>>>>> landing
            $table->timestamps();
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
