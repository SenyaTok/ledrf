<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('promo_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_promo')->nullable();
            $table->text('text_promo')->nullable();
            $table->json('slider_images')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('promo_pages');
    }
};
