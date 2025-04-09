<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\News;
use App\Models\Repo;
use App\Models\static_content;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index()
    {

        return view('frontend.community', [
            'intro' => static_content::where('key', 'community')->first(),
        ]);
    }

    public function show($id)
    {
        $community = Community::query()->with(['news','repos', 'interests'])->findOrFail($id);

//        dd($community);
        return view('frontend.community-single', [
            'community' => $community,
        ]);
    }

    public function profile()
    {
        $repos = auth()->user()->repos;

        return view('frontend.profile', ['repos' => $repos]);
    }
}
