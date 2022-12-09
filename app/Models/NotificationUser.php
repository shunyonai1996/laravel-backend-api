<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class NotificationUser extends Model
{
    use HasFactory;

    protected $fillable = ['notification_id','user_id','read','hide_next','created_at','updated_at'];

    protected $table = 'notification_user';
}