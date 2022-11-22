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
        return $this->hasmany(User::class, 'collection_id', 'id');
    }

    public function notifications() {
        return $this->hasmany(Notification::class);
    }
}
