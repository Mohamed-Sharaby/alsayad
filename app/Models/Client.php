<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Client
 *
 * @property int $id
 * @property string $name
 * @property string|null $area
 * @property string|null $address
 * @property string $phone
 * @property string|null $notes
 * @property int|null $points
 * @property bool $is_active
 * @property int|null $created_by
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin $createdBy
 * @method static \Illuminate\Database\Eloquent\Builder|Client active()
 * @method static \Database\Factories\ClientFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'area',
        'address',
        'phone',
        'notes',
        'points',
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

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }


    public function getTotalSalesAttribute()
    {
        return $this->sales()->where('client_id',$this->id)->sum('total');
    }

    public function getPaidSalesAttribute()
    {
        return $this->sales()->where('client_id',$this->id)->sum('received');
    }

    public function getRemainingSalesAttribute()
    {
        return $this->sales()->where('client_id',$this->id)->sum('remaining');
    }

}
