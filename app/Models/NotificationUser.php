<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\NotificationUser
 *
 * @property int $id
 * @property int $notification_id
 * @property int $user_id
 * @property int $read
 * @property int $hide_next
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser whereHideNext($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser whereNotificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser whereRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser whereUserId($value)
 */
class NotificationUser extends Model
{
    use HasFactory;

    protected $fillable = ['notification_id','user_id','read','hide_next','created_at','updated_at'];

    protected $table = 'notification_user';
}