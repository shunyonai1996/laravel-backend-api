<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\CEO
 *
 * @property int $id
 * @property string $name
 * @property string $company_name
 * @property string $year
 * @property string $company_headquarters
 * @property string $what_company_does
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CEO newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CEO newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CEO query()
 * @method static \Illuminate\Database\Eloquent\Builder|CEO whereCompanyHeadquarters($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CEO whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CEO whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CEO whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CEO whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CEO whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CEO whereWhatCompanyDoes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CEO whereYear($value)
 */
	class CEO extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Collection
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Notification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Collection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Collection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Collection query()
 * @method static \Illuminate\Database\Eloquent\Builder|Collection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Collection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Collection whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Collection whereUpdatedAt($value)
 */
	class Collection extends \Eloquent {}
}

namespace App\Models{
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
	class Notification extends \Eloquent {}
}

namespace App\Models{
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
	class NotificationUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $collection_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \App\Models\Collection $collection
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCollectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

