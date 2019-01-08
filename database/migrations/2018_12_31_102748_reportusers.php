<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Reportusers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportusers', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('user_id');
            $table->Integer('report_id');
            $table->enum('type', ['Hate speech', 'Self harm', 'Bulling and harassment']);
            $table->string('body');
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
        Schema::dropIfExists('reportusers');
    }
}
