<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{

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
            ->where('read',  0)
            ->where('hide_next',  0)
            ->get();
            
            // select `users`.*, `notification_user`.`notification_id` as `pivot_notification_id`, `notification_user`.`user_id` as `pivot_user_id`, `notification_user`.`read` as `pivot_read`, `notification_user`.`hide_next` as `pivot_hide_next`
            // from `users`
            // inner join `notification_user` on `users`.`id` = `notification_user`.`user_id`
            // where `notification_user`.`notification_id` = 12

        // $notification_user = Notification::find(12)->users()->get();

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
        return response([ 'notification' => new NotificationResource($notification), 'message' => 'Retrived Successflly'], 200);
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
