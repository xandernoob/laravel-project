<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('visitors', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('name');
            $table -> string('nric');
            $table -> string('contact');
            $table -> string('unit');
            $table -> timestamps();
            $table -> softDeletes();

            $table->foreignId('condominium_id')->constrained('condominiums')->onDelete('cascade');

        });

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}
