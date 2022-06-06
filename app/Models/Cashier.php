<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_available', 'last_receive_id', 'last_shift_id'];


    public function last_receive()
    {
        return $this->belongsTo(Receiving::class, 'last_receive_id');
    }

    public function last_shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
