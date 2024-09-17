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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('overview');
            $table->text('language');
            $table->string('poster_image')->nullable();
            $table->string('backdrop_image');
            $table->string('video_path');
            $table->date('release_date');
            $table->foreignId('director_id')->constrained('directors')->name('movie_director_id_foreign')->nullable()->onDelete('cascade')->onUpdate('cascade');;
            $table->foreignId('category_id')->constrained('categories')->name('movie_category_id_foreign')->nullable()->onDelete('cascade')->onUpdate('cascade');;
            $table->float('popularity')->default(0);
            $table->integer('processing_progress')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
