<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUssdResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ussd_responses', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->default(0);
            $table->integer('menu_id')->unsigned()->nullable();
            $table->integer('menu_item_id')->unsigned()->nullable();
            $table->string('response', 45);
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
        Schema::dropIfExists('ussd_responses');
    }
}
