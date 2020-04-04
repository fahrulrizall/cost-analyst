<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fgs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('sap_code');
            $table->string('material_desc');
            $table->char('plant');
            $table->float('price_lbs',6,2);
            $table->integer('lbs');
            $table->float('std_price',6,2);
            $table->float('processing_fee',6,2);
            $table->string('category');
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
        Schema::dropIfExists('fgs');
    }
}

