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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_title');
            $table->longText('post_desc')->nullable();
            $table->string('image')->nullable();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('post_status')->nullable();
            $table->enum('account_type', ['user', 'admin'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
