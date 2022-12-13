<?php
/**
 * ユーザー情報を表示するための指令を行う
 * 
 * @version 1.0
 * @author 米内
 */

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\User;
use App\Models\Notification;
use App\Http\Resources\NotificationResource;
use App\Models\NotificationUser;

class UserController extends Controller
{
    /**
     * ユーザー一覧を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = USER::all();
        return response([ 'users' => $users, 'message' => 'Retrieved successfully'], 200);
    }
}