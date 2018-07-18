<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    protected $table = 'users';
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $casts = [
        'interests' => 'array',
        'achievements' => 'array'
    ];

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany('App\Model\Images', 'image_user', 'user_id', 'image_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zodiacSign()
    {
        return $this->belongsTo('App\Model\ZodiacSign', 'zodiac_sign_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Model\City', 'city_id', 'id');
    }

    /**
     * @return mixed
     */
    public function interests()
    {
        return $this->interests;
    }

    /**
     * @return mixed
     */
    public function achievements()
    {
        return $this->achievements;
    }

    /**
     * @param $user_id
     * @return array
     */
    public function getCrossingInterests($user_id)
    {
        $cross_interests = [];
        $friend = User::find($user_id);
        foreach ($friend->interests as $f_interest) {
            if (in_array($f_interest, $this->interests)) {
                array_push($cross_interests, $f_interest);
            }
        }
        return [
            'list' => $cross_interests,
            'count' => (count($friend->interests) / count($this->interests))*100
	    ];
	}

    /**
     * @return array
     */
    public function getShortInfo()
    {
        return [
            'avatar' => App\Models\Image::where(['user_id', '=', $this->id], ['type', '=', 'avatar'])->get(),
            'name'   => $this->getNameAttribute()

	    ];
	}


}
