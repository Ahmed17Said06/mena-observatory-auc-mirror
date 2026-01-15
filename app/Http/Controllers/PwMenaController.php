<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\static_content;
use Illuminate\Http\Request;

class PwMenaController extends Controller
{
    public function index()
    {
        // Get description from static content (can be managed via admin)
        $description = static_content::where('key', 'pw_mena_description')->first();
        
        // Get related blogs tagged with platform work (if available)
        $relatedPosts = Blogs::whereHas('tags', function ($query) {
            $query->where('name', 'like', '%platform%')
                ->orWhere('name', 'like', '%work%')
                ->orWhere('name', 'like', '%gig%');
        })->latest()->take(3)->get();

        return view('frontend.pw_mena')->with([
            'description' => $description,
            'relatedPosts' => $relatedPosts
        ]);
    }
}