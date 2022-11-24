<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function users() {
        return $this->hasmany(User::class);
    }

    public function notifications() {
        return $this->hasmany(Notification::class, 'collection_id', 'id');
    }
}
