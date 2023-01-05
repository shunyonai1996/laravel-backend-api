<?php

/**
 * ユーザー情報を表示するための指令を行う
 * 
 * @version 1.0
 * @author 米内
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * ユーザー一覧を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = USER::all();
        return response(['users' => $users, 'message' => 'Retrieved successfully'], 200);
    }
}
