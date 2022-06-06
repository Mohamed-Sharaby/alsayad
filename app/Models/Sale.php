<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * App\Models\Sale
 *
 * @property int $id
 * @property string|null $code
 * @property \Illuminate\Support\Carbon $date
 * @property int $client_id
 * @property mixed|null $total
 * @property mixed|null $received
 * @property mixed|null $remaining
 * @property bool|null $is_finished
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin $admin
 * @property-read \App\Models\Client $client
 * @property-read \App\Models\Admin $createdBy
 * @method static \Database\Factories\SaleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newQuery()
 * @method static \Illuminate\Database\Query\Builder|Sale onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereIsFinished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereReceived($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereRemaining($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Sale withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Sale withoutTrashed()
 * @mixin \Eloquent
 */
class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected static function booted()
    {
        static::creating(function  ($model)  {
            $model->uuid = (string) Str::uuid();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'date',
        'client_id',
        'total',
        'received',
        'remaining',
        'is_finished',
        'created_by',
        'notes',
        'status',
        'is_points',
        'points_paid',
        'tax',
        'uuid',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date' => 'date',
        'client_id' => 'integer',
        'total' => 'decimal:4',
        'received' => 'decimal:4',
        'remaining' => 'decimal:4',
        'is_finished' => 'boolean',
        'created_by' => 'integer',
    ];


    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }

    public function admin()
    {
        return $this->belongsTo(\App\Models\Admin::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(\App\Models\Admin::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }


    public function transactions()
    {
        return $this->morphMany(\App\Models\Transaction::class, 'billable');
    }


    public function pay($paid_date, $amount, $admin): Transaction
    {
        return $this->transactions()->create([
            'person_type' => Client::class,
            'person_id' => $this->client_id,
            'type' => 'in',
            'paid_date' => $paid_date,
            'amount' => $amount,
            'created_by' => $admin,
        ]);
    }



}
