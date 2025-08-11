<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingsController extends Controller {
    
    public function index(){
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request){

        $payload = (object) $request->all();

        $request->validate([
            'brand_name' => 'required',
            'brand_description' => 'required',
            'country' => 'required',
            'city' => 'required',
            'contact_number' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::uuid().'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('/assets/img'), $imageName);
            $payload->image = $imageName; 
        }

        Setting::updateOrCreate(['id' => $payload->id],(array) $payload);

        return back()->with('success', 'Settings updated successfully!');
    }

    public function handleUpload(Request $request){

        $payload = (object) $request->all();
        $request->validate([
            'software_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'software_favicon' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('software_logo')) {
            $imageName = Str::uuid().'.'.$request->file('software_logo')->extension();
            $request->file('software_logo')->move(public_path('/assets/img'), $imageName);
            $payload->software_logo = $imageName; 
        }

        if ($request->hasFile('software_favicon')) {
            $imageName = Str::uuid().'.'.$request->file('software_favicon')->extension();
            $request->file('software_favicon')->move(public_path('/assets/img'), $imageName);
            $payload->software_favicon = $imageName; 
        }

        $settings = Setting::updateOrCreate(['id' => $payload->id], (array) $payload);

        return back()->with('success', 'Files uploaded successfully.');
    }
}

