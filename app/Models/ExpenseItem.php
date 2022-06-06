<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ExpenseItem
 *
 * @property int $id
 * @property string $name
 * @property bool $is_active
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin $createdBy
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Expense[] $expenses
 * @property-read int|null $expenses_count
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItem active()
 * @method static \Database\Factories\ExpenseItemFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItem whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItem whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ExpenseItem extends Model
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


    public function expenses()
    {
        return $this->hasMany(\App\Models\Expense::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(\App\Models\Admin::class);
    }


}
