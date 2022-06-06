<?php

namespace App\Models;

use Dirape\Token\DirapeToken;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Inventory
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $date
 * @property string|null $code
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin $createdBy
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\InventoryItem[] $inventoryItems
 * @property-read int|null $inventory_items_count
 * @method static \Database\Factories\InventoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory query()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Inventory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'code',
        'created_by',
        'notes',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date' => 'date',
        'created_by' => 'integer',
    ];


    public function inventoryItems()
    {
        return $this->hasMany(\App\Models\InventoryItem::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(\App\Models\Admin::class,'created_by');
    }


}
