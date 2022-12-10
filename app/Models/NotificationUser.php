<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationUser extends Model
{
    use HasFactory;

    protected $fillable = ['notification_id','user_id','read','hide_next','created_at','updated_at'];
    protected $table = 'notification_user';

    public function check_notify_user() {
        $query = DB::table('notifications as n')
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
            ->where('start_date', "<=", date("Y-m-d H:i:s"))
            ->where('end_date', ">=", date("Y-m-d H:i:s"))
            ->where('nu.user_id', null)
            ->orderBy('n.notify_priority')
            ->orderBy('n.id')
            ->get();

        return $query;
    }

    public function auth_user() {
        return Auth::user()->id;
    }

}