<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    use HasFactory;

    public function notifications() {
        return $this->belongsTo(Notification::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    /**
     */
    public function __construct() {
    }
}
