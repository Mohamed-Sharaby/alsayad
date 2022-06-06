<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiving extends Model
{
    use HasFactory;
    protected $fillable = ['cashier_id','shift_id','total','delivered','remaining'];


    public function cashier()
    {
        return $this->belongsTo(Cashier::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }


}
