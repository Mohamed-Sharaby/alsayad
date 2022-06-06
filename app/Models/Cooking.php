<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cooking
 *
 * @property int $id
 * @property string $name
 * @property bool $is_active
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin $createdBy
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking active()
 * @method static \Database\Factories\CookingFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Cooking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'is_active',
        'created_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'is_active' => 'boolean',
        'created_by' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->whereIsActive(1);
    }


    public function createdBy()
    {
        return $this->belongsTo(\App\Models\Admin::class);
    }


}
