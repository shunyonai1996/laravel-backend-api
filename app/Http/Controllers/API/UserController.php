<?php

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
    public function index() {
        $users = USER::all();
        return response([ 'users' => $users, 'message' => 'Retrieved successfully'], 200);
    }

    public function hidepopup(Request $request)
    {
        $data = $request->all();

        $hidepopup = NotificationUser::create($data);

        return response([ 'hidepopup' => $hidepopup, 'message' => 'Created successfully'], 200);
    }
}