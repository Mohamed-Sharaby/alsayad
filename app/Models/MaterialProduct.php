<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MaterialProduct
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $material_id
 * @property int|null $unit_id
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product|null $material
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\Unit|null $unit
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialProduct whereMaterialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialProduct whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MaterialProduct extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','material_id','quantity'];


    public function material()
    {
        return $this->belongsTo(Product::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
