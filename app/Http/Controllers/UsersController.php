<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
class UsersController extends Controller
{
    public function index()
    {
        $users=User::rand();
        return response()->json($users);
    }
    public function show($id)
    {
        $user=User::getUser($id);
        if($user)
            return response()->json($user[0]);
        else{
            $user=new User;
            $user->email=$id;
            $user->save();
            if($user=User::getUser($user->id)){

                return response()->json($user[0]);
            }

        }

    }
    public function related($id){
    	// $users=User::rand();
    }
}
