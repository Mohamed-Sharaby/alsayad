<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'type', 'amount', 'date', 'is_paid', 'notes', 'monthly_total'];
    //protected $dates = ['date'];

    public function admin()
    {
        return $this->belongsTo(\App\Models\Admin::class);
    }

}
