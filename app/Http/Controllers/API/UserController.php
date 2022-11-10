<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = USER::all();
        return response([ 'users' => $users, 'message' => 'Retrieved successfully'], 200);
    }
}
