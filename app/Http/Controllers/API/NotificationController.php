<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Models\NotificationUser;
use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function notify() {
        $notification = new NotificationUser();
        $notify_user = $notification->check_notify_user();
        $auth_user = $notification->auth_user();
         
        if(Auth::check()) {
                return response([ 'notifies' => $notify_user, 'user_id' => $auth_user, 'message' => 'POPUP表示!!!'], 200);
        } else {
            return response( '未認証' );
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
