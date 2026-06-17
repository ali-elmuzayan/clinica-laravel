<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use Illuminate\Http\Request;

class AuthenticateUserController extends Controller
{
    
    public function store(LoginRequest $request) {
        // check the inputs 
        // check the user credentials 
        // check the user is verified
        // create the authentication token
        // return the token

    }
}
