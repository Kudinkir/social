<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::unprepared(<<<SQL
        create table if not exists users
        (
            id serial not null
                constraint users_id_pkey
                    primary key,
            first_name varchar(255) not null,
            last_name varchar(255) not null,
            gender smallint,
            marital_status smallint,
            zodiac_sign_id smallint
                constraint users_zodiac_sign_id_fkey
                    references zodiac_signs
                        on delete restrict,
            interests jsonb,
            achievements jsonb,
            about text,
            phone integer
                constraint users_phone_key
                    unique,
            email varchar(255) not null
                constraint users_email_key
                    unique,
          password varchar(255) not null,
            location geometry(Point,4326),
            city_id integer
                constraint users_city_id_fkey
                    references cities
                        on delete restrict,
            birthday timestamp,
            created_at timestamp,
            updated_at timestamp,
            deleted_at timestamp
        )
        ;
        CREATE INDEX users_marital_status_idx ON users (marital_status);
        CREATE INDEX users_gender_idx ON users (gender);
        CREATE INDEX users_city_id_idx ON users (city_id);
        CREATE INDEX users_zodiac_sign_id_idx ON users (zodiac_sign_id);
        CREATE INDEX users_interests_idx ON users USING gin(interests);
        CREATE INDEX users_achievements_idx ON users USING gin(achievements);
        CREATE INDEX users_location_idx ON users USING GIST(location);
        CREATE INDEX users_birthday_idx ON users USING btree(birthday);

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
        Schema::dropIfExists('users');
    }
}
