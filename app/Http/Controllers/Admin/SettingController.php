<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Settings');
    }


    public function index()
    {
        $pages = Setting::all()->pluck('page')->unique();
        return view('dashboard.settings.index', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {
        $data = $request->all();

        foreach ($data as $key => $value) {
            if ($key == '_token' || !$value) continue;
            {
                if (is_array($value)) {
                    Setting::where(['name' => $key])->update(['ar_title' => $value[0], 'ar_value' => $value[1]]);
                } else {
                    Setting::where(['name' => $key])->update(['ar_value' => $value, 'en_value' => $value]);
                }
            }

            if ($request->has('splash_image')){
                $setting = Setting::whereName('splash_image')->first();
                deleteImage('uploads',$setting->value);
                $image = uploadImage('uploads',$data['splash_image']);
                $setting->update(['ar_value' => $image, 'en_value' => $image]);
            }

        }
        return redirect()->back()->with('success', 'تم التعديل بنجاح');

    }


    public function show($id)
    {
        $settings = Setting::wherePage($id)->get();
        $page = $id;
        return view('dashboard.settings.show', compact('settings', 'page'));
    }


}
