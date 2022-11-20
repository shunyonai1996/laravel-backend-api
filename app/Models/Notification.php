<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'discription', 'start_date', 'end_date', 'image', 'toggle_view'
    ];

    public function reads() {
        return $this->hasMany(Read::class, 'notification_id', 'id');
    }
}