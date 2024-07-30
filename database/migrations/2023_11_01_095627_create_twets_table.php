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
        Schema::create('twets', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('image')->nullable();
            $table->text('content');
            $table->timestamps();
        });

         Schema::create('comments', function (Blueprint $table) {
           $table->id();
           $table->text('body');
           $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
           $table->foreignId('comments_id')->nullable();
           $table->foreignId('twets_id')->constrained('twets')->onDelete('cascade')->onUpdate('cascade');
           $table->timestamps();
         });

          Schema::create('likes', function (Blueprint $table) {
           $table->id();
           $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
           $table->foreignId('comment_id')->constrained('comments')->onDelete('cascade')->onUpdate('cascade');
           $table->timestamps();
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('twets');
        
        
    }
};