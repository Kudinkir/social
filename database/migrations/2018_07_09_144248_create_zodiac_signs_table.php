<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZodiacSignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::unprepared(<<<SQL
            create table if not exists zodiac_signs
            (
                id serial not null
                    constraint zodiac_signs_pkey
                        primary key,
                name varchar(20) not null,
                "from" timestamp(0) not null,
                "to" timestamp(0) not null
            )
            ;
SQL
);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zodiac_signs');
    }
}
