<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_item_selected_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_item_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('category_attribute_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('category_value_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('value')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_item_selected_attributes');
    }
};
