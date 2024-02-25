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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //constrain the user_id to the id of the users table, onDelete cascade means if the user is deleted, all the comments associated with it will be deleted
            $table->foreignId('idea_id')->constrained()->onDelete('cascade'); //constrain the idea_id to the id of the ideas table, onDelete cascade means if the idea is deleted, all the comments associated with it will be deleted
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
