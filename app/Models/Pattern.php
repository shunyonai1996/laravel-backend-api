<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    use HasFactory;

    public function notification() {
        return $this->belongsTo(Notification::class);
    }

    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     */
    public function __construct() {
    }
}
