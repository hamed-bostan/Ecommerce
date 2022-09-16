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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('price');
            $table->string('color');
            $table->integer('stock');
            $table->integer('quantity');
            $table->integer('discount');
            $table->integer('star');
            $table->integer('max_count_per_month')->nullable();
            $table->boolean('has_min')->default(0);
            $table->integer('min')->nullable();
            $table->boolean('has_max')->default(0);
            $table->integer('max')->nullable();
            $table->tinyInteger('sales_number')->default(0);
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
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
        Schema::dropIfExists('products');
    }
};



$table->string('name',40 );
$table->integer('price');
$table->integer('max_count_per_month');
$table->boolean('has_min')->default(0);
$table->integer('min')->nullable();
$table->boolean('has_max')->default(0);
$table->integer('max')->nullable();
