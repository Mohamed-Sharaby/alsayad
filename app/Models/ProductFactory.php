<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFactory extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'quantity', 'date', 'created_by'];

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(\App\Models\Admin::class);
    }

}
