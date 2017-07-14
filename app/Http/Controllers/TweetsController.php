<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tweet;
use App\Response;
use App\User;
class TweetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $tweets=Tweet::getTweets();
        return response()->json($tweets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user=User::where('email',$request->user_id)->get();

        $tweet=new Tweet;
        if($user[0]->id){
            $tweet->user_id=$user[0]->id;
            $tweet->date=date("Y-m-d H:i:s");
            $tweet->tweet=$request->tweet;
            $tweet->save();
            return response()->json($tweet);
        }else{
            $resp=array('error' => true, 'message'=>'Error');
            return response()->json($resp);
        }

    }
    public function retweet(Request $request){
        $tweet=new Tweet;
        if($request->user_id&&$request->destination_tweet_id){
            $tweet->user_id=$request->user_id;
            $tweet->date=date("Y-m-d H:i:s");
            $tweet->tweet=$request->tweet;
            $tweet->save();
            $response= new Response;
            $response->type=1;
            $response->sender_tweet_id=$tweet->id;
            $response->destination_tweet_id=$request->destination_tweet_id;
            $response->save();
            return response()->json($tweet);
        }else{
            $resp=array('error' => true, 'message'=>'Error');
            return response()->json(false);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tweets=Tweet::find($id);
        return response()->json($tweets);
    }


    public function usertweet($id)
    {
         $user=User::getUser($id);
        $tweets=Tweet::getTweetsToUser($user[0]->id);
        return response()->json($tweets);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tweet=Tweet::find($id);
        $tweet->tweet=$request->tweet;
        return response()->json($tweet->save());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tweet=Tweet::find($id);
        if($tweet)
            return response()->json($tweet->delete());

    }
}
