<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';

    public function getAvatarAttribute($user_id)
	{
	    return App\Model\Image::where(['user_id', '=', $this->user_id], ['type', '=', 'avatar'])->get();
	}

	public function getAllAttribute($user_id)
	{
	    return App\Model\Image::where(['user_id', '=', $this->user_id])->get();
	}

}
