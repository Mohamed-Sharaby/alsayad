<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\StorageInvoice
 *
 * @property int $id
 * @property string|null $code
 * @property \Illuminate\Support\Carbon $date
 * @property string $type
 * @property int|null $supplier_id
 * @property mixed|null $total
 * @property mixed|null $received
 * @property mixed|null $remaining
 * @property bool|null $is_finished
 * @property int|null $inventory_id
 * @property int|null $created_by
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin $createdBy
 * @property-read mixed $status
 * @property-read \App\Models\Inventory|null $inventory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StorageInvoiceItem[] $storageInvoiceItems
 * @property-read int|null $storage_invoice_items_count
 * @property-read \App\Models\Supplier|null $supplier
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @method static \Database\Factories\StorageInvoiceFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice in()
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice newQuery()
 * @method static \Illuminate\Database\Query\Builder|StorageInvoice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice out()
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice whereInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice whereIsFinished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice whereReceived($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice whereRemaining($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageInvoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StorageInvoice withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StorageInvoice withoutTrashed()
 * @mixin \Eloquent
 */
class StorageInvoice extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'supplier_invoice_code',
        'type',
        'date',
        'supplier_id',
        'total',
        'received',
        'remaining',
        'is_finished',
        'inventory_id',
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
        'supplier_id' => 'integer',
        'date' => 'date',
        'total' => 'decimal:4',
        'received' => 'decimal:4',
        'remaining' => 'decimal:4',
        'is_finished' => 'boolean',
        'inventory_id' => 'integer',
        'created_by' => 'integer',
    ];

    public function scopeIn($q)
    {
        return $q->whereType('in');
    }

    public function scopeOut($q)
    {
        return $q->whereType('out');
    }


    public function supplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class);
    }

    public function inventory()
    {
        return $this->belongsTo(\App\Models\Inventory::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(\App\Models\Admin::class);
    }

    public function transactions()
    {
        return $this->morphMany(\App\Models\Transaction::class, 'billable');
    }

    public function storageInvoiceItems()
    {
        return $this->hasMany(\App\Models\StorageInvoiceItem::class);
    }

    public function getStatusAttribute()
    {
        return $this->received == 0 ? 'غير مسددة' : ($this->total == $this->received ? 'مسددة' : '  مسددة جزئيا');
    }

    public function pay($paid_date, $amount): Transaction
    {
        return $this->transactions()->create([
            'person_type' => Supplier::class,
            'person_id' => $this->supplier_id,
            'type' => 'out',
            'paid_date' => $paid_date,
            'amount' => $amount,
            'created_by' => auth()->user()->id,
        ]);

    }

}
