<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function tweet()
    {
        return $this->hasMany('App\Tweet');
    }

    public function like()
    {
        return $this->hasMany('App\Like');
    }
    public static function getUser($id){
        return DB::select("SELECT u.id,u.name,u.email,(SELECT COUNT(f.id) FROM follows AS f WHERE f.user_following_id=u.id) AS following,(SELECT COUNT(f.id) FROM follows AS f WHERE f.user_follower_id=u.id) AS follower,(SELECT COUNT(t.id) FROM tweets AS t WHERE t.user_id=u.id) AS tweets
                            FROM users AS u
                            WHERE u.email='$id'
                            GROUP BY u.id");
    }
    public static function recommendedUsers($id){
        return DB::select("SELECT *
                            FROM users
                            WHERE id!=$id AND id NOT IN (SELECT user_following_id
                            FROM users,follows
                            WHERE users.id = user_following_id )
                            ORDER BY RAND()
                            LIMIT 3");
    }


}
