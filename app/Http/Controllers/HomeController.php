<?php

namespace App\Http\Controllers;

use App\Models\Misi;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $visi = Setting::first()->visi;
        $misi2 = Misi::get();

        return view('home', [
            'visi' => $visi,
            'misi2' => $misi2,
            'title' => ''
        ]);
    }
}
