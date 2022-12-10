<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'image'
    ];

    public function collections() {
        return $this->belongsTo(Collection::class);
    }
    
    public function users() {
        return $this->belongsToMany(User::class, 'notification_user')->withPivot(['read', 'hide_next'])->using(NotificationUser::class);
    }

}