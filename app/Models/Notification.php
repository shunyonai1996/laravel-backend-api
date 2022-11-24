<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date', 'end_date', 'image', 'toggle_view'
    ];

    public function collection() {
        return $this->belongsTo(Collection::class);
    }
    
    public function users() {
        return $this->belongsToMany(User::class, 'notification_user', 'collection_id', 'user_id')->withPivot(['read', 'hide_next'])->withTimestamps();
    }
    
}