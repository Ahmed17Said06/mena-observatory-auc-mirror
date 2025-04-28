<?php

namespace App\Http\Controllers;

use App\Models\AdditionalResource;
use App\Models\countries;
use App\Models\Regional;
use App\Models\Repo;
use App\Models\Repo_tags;
use App\Models\Repo_theme;
use App\Models\Repo_type;
use App\Models\static_content;
use Illuminate\Http\Request;

class RegionalController extends Controller
{
    public function index()
    {
        return view('frontend.regional')
            ->with([
                'intro' => static_content::where('key', 'regional intro')->first(),
                'repo_types' => Repo_type::All(),
                'repo_tags' => Repo_tags::All(),
                'repo_themes' => Repo_theme::All()
            ]);
    }

    public function single($id)
    {
        $repo = Repo::with('tags', 'pdfFiles')->findOrFail($id);
        $repo->views+=1;
        $repo->save();

        return view('frontend.repo-single')->with([
            'repo' => $repo,
        ]);
    }

    public function country($id)
    {
        return view('frontend.country')
            ->with([
                'repos' => Repo::Where('country_id', $id)->get(),
                'country' => countries::find($id),
                'resources' => AdditionalResource::query()->where('country_id',$id)->latest()->get()
            ]);
    }

    public function js_list_view(Request $request)
    {
        if ($request->get('country_id'))
            $repos = Repo::Where('country_id', $request->country_id)->get();
        else
            $repos = Repo::all();
        return response()->json([
            'success' => true,
            'html' => view('frontend.components.regional')->with(['repos' => $repos])->render()
        ]);
    }

    public function dataRepo()
    {
        // This reuses the same logic as the index method for Knowledge Hub
        return view('frontend.regional')
            ->with([
                'intro' => static_content::where('key', 'regional intro')->first(),
                'repo_types' => Repo_type::where('id', 3)->get(),  // Only get DATA DEPOSITORY type (ID 3)
                'repo_tags' => Repo_tags::All(),
                'repo_themes' => Repo_theme::All(),
                'is_data_repo_page' => true // Add this flag to indicate it's the Data Repository page
            ]);
    }
}
