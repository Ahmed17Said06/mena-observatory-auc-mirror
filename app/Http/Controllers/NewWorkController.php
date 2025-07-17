<?php

namespace App\Http\Controllers;

use App\Models\PolicyBrief;
use App\Models\static_content;
use App\Models\NewWorkBlog;
use Illuminate\Http\Request;

class NewWorkController extends Controller
{
    public function index()
    {
        $description = static_content::where('key', 'new_work_description')->first();

        return view('frontend.new_work')->with([
            'description' => $description
        ]);
    }

    public function reports()
    {
        $newWorkBlogs = NewWorkBlog::published()->orderBy('published_at', 'desc')->paginate(6);
        $description = static_content::where('key', 'new_work_description')->first();

        return view('frontend.new-work-reports')->with([
            'newWorkBlogs' => $newWorkBlogs,
            'description' => $description
        ]);
    }

    public function reportsHtmlList()
    {
        $newWorkBlogs = NewWorkBlog::published()->orderBy('published_at', 'desc')->paginate(3);
        
        return view('livewire.new-work-reports', [
            'newWorkBlogs' => $newWorkBlogs
        ])->render();
    }

    public function policyBriefs()
    {
        // Dedicated policy briefs page shows 6 items per page
        $policyBriefs = PolicyBrief::published()->orderBy('published_at', 'desc')->paginate(6);
        $description = static_content::where('key', 'new_work_description')->first();

        return view('frontend.new-work-policy-briefs')->with([
            'policyBriefs' => $policyBriefs,
            'description' => $description
        ]);
    }

    public function policyBriefsHtmlList(Request $request)
    {
        $policyBriefs = PolicyBrief::published()->orderBy('published_at', 'desc')->paginate(6);
        
        return response()->json([
            'success' => true,
            'html' => view('frontend.components.policy-briefs', compact('policyBriefs'))->render(),
            'pagination' => view('components.frontend.news-pagination', ['paginator' => $policyBriefs])->render()
        ]);
    }
}
