<?php

/**
 * Setting Name
 *
 * @param $name
 * @return mixed
 */
function getsetting($name)
{
    $setting = \App\Models\Setting::where('name', $name)->first();
    if (!$setting) {
        return "";
    }

    return $setting->value;
}

function suppliers(){
    return \App\Models\Supplier::pluck('name','id');
}

function clients(){
    return \App\Models\Client::pluck('name','id');
}

function products(){
    return \App\Models\Product::isProduct()->pluck('name','id');
}


function verify_status()
{
    $array = [
        'approved' => 'قبول',
        'rejected' => 'رفض',
    ];

    return $array;
}
function types()
{
    return [
        'ready' => 'منتج جاهز',
        'made' => 'منتج مصنوع',
       // 'material' => 'مادة خام',
    ];
}

function bonusTypes()
{
    return [
        'salary' => 'مرتب',
        'increase' => 'مكافأة',
        'deduction' => 'خصم',
    ];
}

function is_cooking()
{
    return [
        '0' => 'لا يحتاج',
        '1' => 'يحتاج',
    ];
}

function made_in_order()
{
    return [
        '0' => 'اضافة مخزون',
        '1' => 'مع البيع',
    ];
}

/**
 * Upload Path
 *
 * @return string
 */
function uploadpath()
{
    return 'photos';
}

/**
 * Get Image
 *
 * @param $filename
 * @return string
 */
function getimg($filename)
{
    return asset($filename);
}

////////////////////////////////////////////////////////////////////////

function uploadImage($file, $img)
{
    return '/storage/' . \Storage::disk('public')->putFile($file, $img);
}

function deleteImage($file, $img)
{
    \Storage::disk('public')->delete($file, $img);

    return true;
}

function getImgPath($img)
{
    return asset($img);
}


