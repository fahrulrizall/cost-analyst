<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pt_name');
            $table->string('sap_code');
            $table->string('validate');
            $table->string('material_desc');
            $table->string('plant');
            $table->float('price_lbs',5,2);
            $table->float('processing_fee',4,2);
            $table->string('category');
            $table->integer('lbs');
            $table->string('loin');
            $table->float('mac',4,2);
            $table->float('result',6,2);
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
        Schema::dropIfExists('pts');
    }
}
