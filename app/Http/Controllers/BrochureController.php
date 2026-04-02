<?php

namespace App\Http\Controllers;

use App\Models\Brochure;

class BrochureController extends Controller
{
    public function show(string $slug)
    {
        $brochure = Brochure::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('frontend.brochure-single', compact('brochure'));
    }
}
