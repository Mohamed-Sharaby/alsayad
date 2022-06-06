<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'cashier_id','start_at', 'end_at','is_open'];


    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function cashier()
    {
        return $this->belongsTo(Cashier::class);
    }

    public function receiving()
    {
        return $this->hasOne(Receiving::class);
    }




//    public  function  finish($total,$delivered){
//
//        $this->fill(['end_at'=>now()]);
////        get amount of total purchases during the shift
////         create receiving
//
////        update cashier  with new shift and new receiving
////        finish shift
//        $this->cashier()->update([
//            'last_receive_id'=>$receiving->id,
//        ]);
//
//    }







        ////////////////////////
        //        get amount of total purches during the shift
//         create receiving
//        update cashier  with new shift and new receiving
//        finish shift
        //get total of receiving

}
