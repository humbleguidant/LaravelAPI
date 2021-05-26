<?php
/**
 * Author: Aubrey Nickerson
 * Date: May 25th, 2021
 * Program: 2021_05_24_232839_create_people_table.php
 * Project: Global Protection Code Challenge
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * This will create the 'people'
     * table in the MySQL database.
     *
     * The columns are based off of
     * the personal fields from the
     * random person API.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('age');
            $table->string('blood');
            $table->string('born')->nullable();
            $table->string('born_place');
            $table->string('cellphone');
            $table->string('city');
            $table->string('country');
            $table->string('eye_color');
            $table->string('father_name');
            $table->string('gender');
            $table->string('height');
            $table->string('last_name');
            $table->string('name');
            $table->string('national_code');
            $table->string('religion');
            $table->string('system_id');
            $table->integer('weight');
            $table->string('avatar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
