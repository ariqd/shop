<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('setting.index', [
            'settings' => Setting::all()->keyBy('key')
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'target_revenue' => ['required', 'numeric', 'min:1000'],
            'target_products_sold' => ['required', 'numeric', 'min:10'],
        ]);

        foreach ($validatedData as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            $setting->value = $value;
            $setting->save();
        }

        return redirect()->back()->with('info', 'Target berhasil di update!');
    }
}
