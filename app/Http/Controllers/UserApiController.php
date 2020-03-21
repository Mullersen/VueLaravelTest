<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserApiController extends Controller
{
    function getAllUsers(){
        $userCollection = \App\User::all(); // this is returning a collection( an array of objects - in php its an associative array)
        $userJson = $userCollection->toJson();
        return response()->json($userJson);

    }
}
