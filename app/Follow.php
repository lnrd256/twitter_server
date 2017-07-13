<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{

	public function user_following()
    {
        return $this->belongsTo('App\User','id','user_following_id');
    }

    public function user_follower()
    {
        return $this->belongsTo('App\User','id','user_follower_id');
    }
}
