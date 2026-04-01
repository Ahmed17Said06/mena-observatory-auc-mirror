<?php

namespace App\Http\Controllers;

use App\Models\static_content;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {

        return view('frontend.about_us');
    }
}
