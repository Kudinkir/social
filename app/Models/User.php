<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $guarded = [];#какие отрибуты нельзя менять (сейчас все)

    #protected $fillable = [];#какие отрибуты можно менять
    
    protected $casts = [#будет автоматом преобразовывать содержимое в array 
    	'interests' => 'array', 
    	'achievements' => 'array'
    ];

    #Попридумывать всю хурму мира


	public function getNameAttribute() #можно будет обращаться $this->name
	{
	   return $this->first_name.' '.$this->last_name;
	}

	public function images()
	{
	   return $this->belongsToMany('App\Model\Image', 'image_user', 'user_id', 'image_id');
	}

	public function zodiacSign()
	{
	   return $this->belongsTo('App\Model\ZodiacSign', 'zodiac_sign_id', 'id');
	}

	public function city()
	{
	   return $this->belongsTo('App\Model\City', 'city_id', 'id');
	}

	public function interests()
	{
	   return $this->interests;
	}

	public function achievements()
	{
	   return $this->achievements;
	}

	public function getСrossingInterests($user_id)
	{
		$cross_interests = [];
		$friend = User::find($user_id);
		foreach ($friend->interests as $f_interest) {
			if (in_array($f_interest, $this->interests)){
				array_push($cross_interests, $f_interest);
			}
		}
	    return [
	    	'list'  => $cross_interests,
	    	'count' => (count($this->getСrossingInterests($user_id))\count($this->interests()))*100 
	    ];
	}

	public function getShortInfo()
	{
	    return [ 
	    	'avatar' => App\Model\Image::where(['user_id', '=', $this->id], ['type', '=', 'avatar'])->get();,
	    	'name'   => $this->getNameAttribute()

	    ];
	}


}
