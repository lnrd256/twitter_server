<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function about(){
    	$nombre="piter petreli";
    	$tweets=\App\User::find(1)->paginate(2);
    	return response()->json($tweets);

    }
}
