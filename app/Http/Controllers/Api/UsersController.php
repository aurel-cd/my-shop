<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function showUsers(){
        $users = User::all();
        return $users;
    }

    public function showUser(User $user){
        return $user;
    }
}
