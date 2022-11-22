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

    public function users() {
        return $this->hasMany(User::class);
    }

    public function collection() {
        return $this->belongsToMany(Collection::class);
    }
    
}