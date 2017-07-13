<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Tweet extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function like()
    {
        return $this->hasMany('App\Like');
    }
    public static function getTweetsToUser($id){
    	return DB::select("SELECT t.*,u.name,u.email,
                                (SELECT COUNT(id)
                                FROM responses
                                WHERE responses.type_response=1 AND t.id=responses.destination_tweet_id) AS response,
                                (SELECT COUNT(id)
                                FROM responses
                                WHERE responses.type_response=2 AND t.id=responses.destination_tweet_id) AS retweet,
                                (SELECT COUNT(id)
                                FROM likes
                                WHERE likes.tweet_id=t.id) AS likes


                            FROM tweets AS t,users AS u
                            WHERE u.id=t.user_id
                            GROUP BY t.id
                            ORDER BY t.date DESC ");
    }
}
