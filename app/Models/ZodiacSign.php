<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZodiacSign extends Model
{
    protected $table = 'zodiac_signs';

    public function getUserZodiacAttribute($user_birthday)
	{
	    return $this->query->where(['from', '>', $user_birthday], ['to', '<=', $user_birthday]);
	}

	public function getAllAttribute()
	{
	    return $this->all();
	}
}
