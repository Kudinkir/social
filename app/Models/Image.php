<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    /**
     * @param $user_id
     * @return mixed
     */
    public function getAvatarAttribute($user_id)
	{
	    return Image::where(['user_id', '=', $user_id], ['type', '=', 'avatar'])->get();
	}

    /**
     * @param $user_id
     * @return mixed
     */
	public function getAllAttribute($user_id)
	{
	    return Image::where(['user_id', '=', $user_id])->get();
	}

}
