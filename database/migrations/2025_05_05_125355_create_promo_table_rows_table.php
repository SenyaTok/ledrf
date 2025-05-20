<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('promo_table_rows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('promo_page_id');
            $table->json('columns')->nullable();
            $table->timestamps();

            $table->foreign('promo_page_id')->references('id')->on('promo_pages')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('promo_table_rows');
    }
};
