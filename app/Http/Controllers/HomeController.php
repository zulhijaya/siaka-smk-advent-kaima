<?php

namespace App\Http\Controllers;

use App\Models\Misi;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $misi2 = Misi::get();

        return view('home', [
            'setting' => $setting,
            'misi2' => $misi2,
            'title' => ''
        ]);
    }
}
