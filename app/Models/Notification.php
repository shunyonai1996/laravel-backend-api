<?php

/**
 * App\Models\Notification
 *
 * @property int $id
 * @property string $end_date
 * @property string $start_date
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $already_read
 * @property int $hide_next_time
 * @property string $jump_link
 * @property int $notify_priority
 * @property int $collection_id
 * @property-read \App\Models\Collection|null $collections
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereAlreadyRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCollectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereHideNextTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereJumpLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereNotifyPriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 */

namespace App\Models;

use App\Models\Notification as ModelsNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'image'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'notification_user')->withPivot(['read', 'hide_next'])->using(NotificationUser::class);
    }

    public function patterns() {
        return $this->belongsTo(Patterns::class);
    }

    /**
     * POPUP情報取得クエリ
     * リクエストユーザーIDを参照し、表示すべきPOPUPのみreturn
     * 
     * @return string,string|mixed 取得結果
     */
    public function check_notify_user($auth_user_id)
    {
        $query = DB::table('notifications as n')
            ->select(
                'n.id as id',
                'n.image as image',
                'n.already_read as already_read',
                'n.hide_next_time as hide_next_time',
                'n.jump_link as jump_link',
                'n.notify_priority as notify_priority',
                'nu.read as read',
                'nu.hide_next as hide_next'
            )
            ->leftJoin('notification_user as nu', function ($join) use ($auth_user_id) {
                $join->on('n.id', "=", 'nu.notification_id')
                    ->where('nu.user_id', "=", $auth_user_id);
            })
            ->where('start_date', "<=", date("Y-m-d H:i:s"))
            ->where('end_date', ">=", date("Y-m-d H:i:s"))
            ->whereNull('nu.user_id')
            ->orderBy('n.notify_priority')
            ->orderBy('n.id')
            ->get();

        return $query;
    }
}
