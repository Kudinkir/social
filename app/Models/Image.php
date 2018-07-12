<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';

    /**
     * @param $user_id
     * @return mixed
     */
    public function getAvatarAttribute($user_id)
	{
	    return Images::where(['user_id', '=', $this->user_id], ['type', '=', 'avatar'])->get();
	}

    /**
     * @param $user_id
     * @return mixed
     */
	public function getAllAttribute($user_id)
	{
	    return Images::where(['user_id', '=', $this->user_id])->get();
	}

}
