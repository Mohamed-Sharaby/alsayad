<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StorageInvoiceItem
 *
 * @property int $id
 * @property int $storage_invoice_id
 * @property int $product_id
 * @property mixed $buying_price
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\StorageInvoice $storageInvoice
 * @method static \Database\Factories\StorageInvoiceItemFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoiceItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoiceItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoiceItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoiceItem whereBuyingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoiceItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoiceItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoiceItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoiceItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoiceItem whereStorageInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoiceItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class StorageInvoiceItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'storage_invoice_id',
        'product_id',
        'buying_price',
        'quantity',
        'unit_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'storage_invoice_id' => 'integer',
        'product_id' => 'integer',
        'buying_price' => 'decimal:4',
    ];

    protected static function booted()
    {
        parent::booted();
        static::created(function ($item) {
            /* @var self $item */
            $item->product()->update(['buying_price' => $item->buying_price]);
        });
        static::updated(function ($item) {
            /* @var self $item */
            $item->product()->update(['buying_price' => $item->buying_price]);
        });
    }

    public function storageInvoice()
    {
        return $this->belongsTo(\App\Models\StorageInvoice::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    public function unit()
    {
        return $this->belongsTo(\App\Models\Unit::class);
    }

}
