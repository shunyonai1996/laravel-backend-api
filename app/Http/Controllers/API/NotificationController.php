<?php

/**
 * POPUP情報を登録、表示、削除するための指令を行う
 * 
 * @version 1.0
 * @author 米内
 */

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Models\NotificationUser;
use App\Models\User;

class NotificationController extends Controller
{
    /**
     * ユーザーに表示するPOPUP情報取得
     * リクエストユーザーIDを参照し、表示すべきPOPUP情報のみ取得する
     * 
     * @return \Illuminate\Http\Response
     */
    public function notify()
    {
        $notification = new Notification();
        $user = new User();

        //認証済みの場合、POPUPを表示する
        if (Auth::check()) {
            //Modelのメソッドを変数に代入
            $auth_user_id = $user->auth_user_id();
            $notifies = $notification->check_notify_user($auth_user_id);

            return response(['notifies' => $notifies, 'user_id' => $auth_user_id, 'message' => 'successfully'], 200);
        } else {
            return response('未認証');
        }
    }

    /**
     * POPUP非表示処理
     * ユーザーが「次回から表示しない」or「既読」にチェック&閉じた時に実行
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function hidepopup(Request $request)
    {
        $data = $request->all();

        $hidepopup = NotificationUser::create($data);

        return response(['hidepopup' => $hidepopup, 'message' => 'Created successfully'], 200);
    }

    /**
     * POPUP情報を登録
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $notification = Notification::create($data);

        $validator = Validator::make($data, [
            'start_date' => 'required',
            'end_date' => 'required',
            'image' => 'required',
            'already_read' => 'required',
            'hide_next_time' => 'required',
            'notify_priority' => 'required',
            'group_id' => 'required',
            'collection_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        return response(['notification' => new NotificationResource($notification), 'message' => 'Created successfully'], 200);
    }

    /**
     * POPUP情報を削除
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();

        return response(['message', 'Deleted!']);
    }
}
