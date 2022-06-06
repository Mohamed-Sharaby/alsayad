<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InventoryItem
 *
 * @property int $id
 * @property int $inventory_id
 * @property int $product_id
 * @property int $storage_quantity
 * @property int $exists_quantity
 * @property int|null $difference
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $diff
 * @property-read \App\Models\Inventory $inventory
 * @property-read \App\Models\Product $product
 * @method static \Database\Factories\InventoryItemFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereDifference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereExistsQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereStorageQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InventoryItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inventory_id',
        'product_id',
        'storage_quantity',
        'exists_quantity',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'storage_quantity'=> 'integer',
        'exists_quantity' => 'integer',
        'inventory_id' => 'integer',
        'product_id' => 'integer',
    ];


    public function inventory()
    {
        return $this->belongsTo(\App\Models\Inventory::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    public function getDiffAttribute(): int
    {
        return $this->storage_quantity - $this->exists_quantity;
    }

    public function DifferenceHasEdited($difference)
    {
        return $difference != $this->diff;
    }

    public function getEditedQuantity($difference): array
    {
        if ($this->diff >= 0 && $difference >= 0) {
            return [
                'type' => 'in',
                'amount' => abs($this->diff - $difference)
            ];
        }

        if ($this->diff <= 0 && $difference <= 0) {
            return [
                'type' => 'out',
                'amount' => abs($this->diff - $difference)
            ];
        }

        if ($this->diff > 0 && $difference < 0) {
            $q = $this->storage_quantity - $this->exists_quantity;
            return [
                'type' => 'out',
                'amount' => abs($q + $difference)
            ];
        }


        if ($this->diff < 0 && $difference > 0) {
            $q = $this->exists_quantity - $this->storage_quantity;
            return [
                'type' => 'in',
//                'amount' => abs($q + $difference)
                'amount' => abs($q + $difference)
            ];
        }

    }

    public function getIsStorageGreaterAttribute(): bool
    {
        return $this->storage_quantity > $this->exists_quantity;
    }

    public function getIsExistsGreaterAttribute(): bool
    {
        return $this->storage_quantity < $this->exists_quantity;
    }

}
