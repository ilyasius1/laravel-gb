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
        Schema::create('news_sources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('link');
            $table->boolean('is_active')->default(true);
            $table->foreignId('category_id')
                ->nullable()
                ->references('id')
                ->on('categories')
                ->nullOnDelete();
            $table->string('item_field', 200);
            $table->string('title_field', 200);
            $table->string('author_field', 200)->nullable();
            $table->string('origin_link_field', 200)->nullable();
            $table->string('image_field', 200)->nullable();
            $table->string('description_field', 200)->nullable();
            $table->timestamp('last_run_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_sources');
    }
};
