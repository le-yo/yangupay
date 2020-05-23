<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUssdMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ussd_menus', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('is_root')->default(0);
            $table->string('description')->nullable();
            $table->integer('type')->default(1);
            $table->boolean('skippable')->default(0);
            $table->integer('next_mifos_ussd_menu_id')->default(0);
            $table->string('confirmation_message')->nullable();
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
        Schema::dropIfExists('ussd_menus');
    }
}
