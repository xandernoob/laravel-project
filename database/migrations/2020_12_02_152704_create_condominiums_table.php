<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondominiumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condominiums', function (Blueprint $table) {
            $table -> BigIncrements('id');
            $table -> string('unit');
            $table -> string('owner');
            $table -> string('contact');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('condominiums');
    }
}
