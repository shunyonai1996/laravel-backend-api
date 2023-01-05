<?php

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

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CEO extends Model
{
    protected $fillable = [
        'name',
        'company_name',
        'year',
        'company_headquarters',
        'what_company_does'
    ];
}
