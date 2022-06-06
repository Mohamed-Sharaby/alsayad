<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SaleItem
 *
 * @property int $id
 * @property int $product_id
 * @property int $sale_id
 * @property int|null $cooking_id
 * @property int $quantity
 * @property mixed $product_price
 * @property int $total_product_price
 * @property mixed|null $cooking_price
 * @property mixed $total
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin $admin
 * @property-read \App\Models\Cooking|null $cooking
 * @property-read \App\Models\Admin $createdBy
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Sale $sale
 * @method static \Database\Factories\SaleItemFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereCookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereCookingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereProductPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereTotalProductPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SaleItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'sale_id',
        'cooking_id',
        'quantity',
        'product_price',
        'total_product_price',
        'cooking_price',
        'total',
        'created_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'sale_id' => 'integer',
        'cooking_id' => 'integer',
        'product_price' => 'decimal:4',
        'cooking_price' => 'decimal:4',
        'total' => 'decimal:4',
        'created_by' => 'integer',
    ];


    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    public function sale()
    {
        return $this->belongsTo(\App\Models\Sale::class);
    }

    public function cooking()
    {
        return $this->belongsTo(\App\Models\Cooking::class);
    }

    public function admin()
    {
        return $this->belongsTo(\App\Models\Admin::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(\App\Models\Admin::class);
    }

//    public function getTotalProductPriceAttribute()
//    {
//        return $this->product_price * $this->quantity;
//    }

//    public function getTotalAttribute()
//    {
//        if ($this->cooking_price) {
//            return $this->total_product_price + $this->cooking_price;
//        }
//        return $this->total_product_price;
//    }

}
