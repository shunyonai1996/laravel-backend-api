<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function notify(Request $request) {
        $model = new Notification();
        $auth_user = Auth::user();
        $check_notify_user = DB::table('notifications as n')
            ->select( 'n.id as id',
                      'n.image as image',
                      'n.already_read as already_read', 
                      'n.hide_next_time as hide_next_time', 
                      'n.jump_link as jump_link', 
                      'n.notify_priority as notify_priority',
                      'nu.read as read',
                      'nu.hide_next as hide_next' )
            ->leftJoin('notification_user as nu', function ($join) {
                $join->on('n.id', "=", 'nu.notification_id')
                     ->where('nu.user_id', "=", auth()->user()->id);
            })
            ->where('nu.user_id', null)
            ->orderBy('n.notify_priority')
            ->orderBy('n.id')
            ->get();
         
        if(Auth::check()) {
                return response([ 'notifies' => $check_notify_user, 'user_id' => $auth_user->id , 'message' => 'POPUP表示!!!'], 200);
        } else {
            return response( 'ログインしてください!!' );
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::all();
        $notification_user = DB::table('notifications')
            ->leftJoin('notification_user', 'notification_user.notification_id', "=", 'notifications.id')
            ->where('read', 0)
            ->where('hide_next', 0)
            ->get();

        return response([ 'notifications' => NotificationResource::collection($notifications), 'read' => $notification_user, 'message' => 'Successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

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

        
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $notification = Notification::create($data);

        return response([ 'notification' => new NotificationResource($notification), 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        return response([ 'notification' => new NotificationResource($notification), 'message' => 'Retrived Successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
