<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatternUser extends Model
{
    use HasFactory;

    protected $fillable = ['pattern_id', 'user_id', 'created_at', 'updated_at'];

    protected $table = 'pattern_user';
}
