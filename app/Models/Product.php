<?php

namespace App\Models;

use App\Http\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property bool $made_in_order
 * @property string|null $image
 * @property mixed|null $selling_price
 * @property string|null $buying_price
 * @property string|null $made_cost
 * @property int|null $start_quantity
 * @property bool $is_active
 * @property int|null $created_by
 * @property int|null $unit_id
 * @property int|null $category_id
 * @property string|null $notes
 * @property int $is_cooking
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin $admin
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\Admin $createdBy
 * @property-read float $cost
 * @property-read bool $is_made
 * @property-read bool $is_runtime
 * @property-read mixed $is_runtime_made
 * @property-read \Illuminate\Database\Eloquent\Collection|Product[] $productMaterials
 * @property-read int|null $product_materials_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StorageInvoice[] $startInvoices
 * @property-read int|null $start_invoices_count
 * @property-read \App\Models\Unit|null $unit
 * @method static \Illuminate\Database\Eloquent\Builder|Product active()
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Product isProduct()
 * @method static \Illuminate\Database\Eloquent\Builder|Product materials()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBuyingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsCooking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMadeCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMadeInOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStartQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory, HasImage;


    protected static function booted()
    {
        static::deleting(function ($model) {
            if ($model->image) {
                $image = str_replace(url('/') . '/storage/', '', $model->image);
                deleteImage('uploads', $image);
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'made_in_order', 'image', 'selling_price', 'buying_price', 'is_active',
        'created_by', 'unit_id', 'category_id', 'start_quantity', 'notes', 'made_cost', 'is_cooking'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'made_in_order' => 'boolean',
        'selling_price' => 'decimal:4',
        'is_active' => 'boolean',
        'created_by' => 'integer',
        'unit_id' => 'integer',
    ];

     // protected $appends = ['quantity', 'restaurant_quantity'];
      protected $appends = ['quantity'];

    public function scopeActive($query)
    {
        return $query->whereIsActive(1);
    }

    public function suppliers()
    {
        return $this->belongsToMany(\App\Models\Supplier::class);
    }

    public function unit()
    {
        return $this->belongsTo(\App\Models\Unit::class);
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function admin()
    {
        return $this->belongsTo(\App\Models\Admin::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(\App\Models\Admin::class);
    }


    public function startInvoices()
    {
        return $this->HasMany(StorageInvoice::class)->whereNull('supplier_id');
    }

    public function productFactory()
    {
        return $this->hasOne(\App\Models\ProductFactory::class);
    }

    public function scopeMaterials()
    {
        return $this->whereType('material');
    }

    public function scopeIsProduct()
    {
        return $this->where('type', '!=', 'material');
    }

    public function productMaterials()
    {
        return $this->belongsToMany(Product::class,
            'material_products', 'product_id', 'material_id')
            ->withPivot('quantity', 'unit_id');
    }


    /**
     * @return bool
     */
    public function getIsMadeAttribute(): bool
    {
        return $this->type === 'made';
    }

    /**
     * @return bool
     */
    public function getIsRuntimeAttribute(): bool
    {
        return $this->made_in_order === 0;
    }


    public function getIsRuntimeMadeAttribute()
    {
        return ($this->is_made && $this->is_runtime);
    }

    public function addStartStorageInvoice($quantity)
    {
        if (!$this->is_runtime_made) {
            /** @var StorageInvoice $storage_invoice */
            $storage_invoice = StorageInvoice::create([
                'code' => Str::random(8),
                'date' => now(),
                'type' => 'in',
                'total' => 0,
                'received' => 0,
                'created_by' => auth()->id(),
            ]);
            $storage_invoice->storageInvoiceItems()->create(
                [
                    'product_id' => $this->id,
                    'buying_price' => $this->buying_price ?? 0,
                    'quantity' => $quantity,
                ]
            );
        }
    }

//    public function discountMaterialQuantitiesOfMadeProduct($materials)
//    {
//        foreach ($materials as $material) {
//            $item = Product::findOrFail($material['material_id']);
//            $item->update([
//                'start_quantity' => $item->start_quantity - $material['quantity']
//            ]);
//        }
//    }

    public function MaterialCost(): float
    {
        return $this->productMaterials->sum(fn($product) => $product->cost * $product->pivot->quantity);
    }

    public function getCostAttribute(): float
    {
        if ($this->is_made) {
            return $this->MaterialCost() + $this->made_cost;
        }
        return $this->buying_price;
    }


    public function storage_quantity()
    {
        return $this->hasOne(StorageQuantity::class);
    }

    public function restaurant_quantity()
    {
        return $this->hasOne(RestaurantQuantity::class);
    }

    public function getQuantityAttribute() :int
    {
        return $this->storage_quantity->quantity ?? 0;
    }

    public function getQuantityInRestaurantAttribute() :int
    {
        return $this->restaurant_quantity->quantity ?? 0;
    }

    public function getSalesRestaurantQuantityAttribute() :int
    {
        return $this->restaurant_quantity->sales ?? 0;
    }

    public function getRemainingRestaurantQuantityAttribute() :int
    {
         return $this->restaurant_quantity->remaining ?? 0;
    }

    public function getBuyingPriceAttribute() :int
    {
        return  ($this->storage_quantity ? $this->storage_quantity->buying_price : $this->getAttributes()['buying_price'])??0;
    }

    public function getBillQuantityAttribute():int
    {
        return $this->getQuantityInRestaurantAttribute() - $this->getSalesRestaurantQuantityAttribute();
    }

    public function createProductFactory($quantity)
    {
        ProductFactory::create([
            'product_id' => $this->id,
            'quantity' => $quantity,
            'date' => now(),
            'created_by' => auth()->id(),
        ]);
    }

}
