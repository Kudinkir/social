<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         \DB::unprepared(<<<SQL
           create table if not exists images
            (
                id serial not null
                    constraint images_pkey
                        primary key,
                name varchar(255) not null,
                thumbnail varchar(255) not null,
                hash varchar(255) not null,
                deleted_at timestamp(0),
                created_at timestamp(0),
                updated_at timestamp(0)
            );
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
        Schema::dropIfExists('images');
    }
}
