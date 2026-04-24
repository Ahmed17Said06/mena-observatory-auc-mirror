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
use App\Models\YoutubeVideo;
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
                'repo_themes' => Repo_theme::All(),
                'isOurWork' => null,
                'isGlobal' => null,
            ]);
    }

    public function ourWork()
    {
        return view('frontend.regional')
            ->with([
                'intro' => static_content::where('key', 'regional intro')->first(),
                'repo_types' => Repo_type::All(),
                'repo_tags' => Repo_tags::All(),
                'repo_themes' => Repo_theme::All(),
                'isOurWork' => true,
                'isGlobal' => null,
            ]);
    }

    public function regionalOtherWork()
    {
        return view('frontend.regional')
            ->with([
                'intro' => static_content::where('key', 'regional intro')->first(),
                'repo_types' => Repo_type::All(),
                'repo_tags' => Repo_tags::All(),
                'repo_themes' => Repo_theme::All(),
                'isOurWork' => false,
                'isGlobal' => false,
            ]);
    }

    public function globalOtherWork()
    {
        return view('frontend.regional')
            ->with([
                'intro' => static_content::where('key', 'regional intro')->first(),
                'repo_types' => Repo_type::All(),
                'repo_tags' => Repo_tags::All(),
                'repo_themes' => Repo_theme::All(),
                'isOurWork' => false,
                'isGlobal' => true,
            ]);
    }

    public function genderResources()
    {
        $repos = Repo::whereHas('tags', fn($q) => $q->where('name', 'Gender'))
            ->with(['tags', 'repoType', 'pdfFiles', 'authors'])
            ->latest()
            ->get();

        $sections = [
            [
                'key'      => 'observatory',
                'title'    => 'Observatory Outputs',
                'subtitle' => 'Research, publications, and reports produced by our team',
                'color'    => '#022448',
                'repos'    => $repos->where('is_our_work', true)
                                   ->groupBy(fn($r) => optional($r->repoType)->name ?? 'Other'),
            ],
            [
                'key'      => 'regional',
                'title'    => 'Regional Resources',
                'subtitle' => 'External research and resources from the MENA region',
                'color'    => '#006644',
                'repos'    => $repos->filter(fn($r) => !$r->is_our_work && !$r->is_global)
                                   ->groupBy(fn($r) => optional($r->repoType)->name ?? 'Other'),
            ],
            [
                'key'      => 'global',
                'title'    => 'Global Resources',
                'subtitle' => 'International research and resources on responsible AI',
                'color'    => '#c8870a',
                'repos'    => $repos->filter(fn($r) => !$r->is_our_work && $r->is_global)
                                   ->groupBy(fn($r) => optional($r->repoType)->name ?? 'Other'),
            ],
        ];

        return view('frontend.gender-resources', compact('sections'));
    }

    public function videos()
    {
        return view('frontend.videos')
            ->with([
                'videos' => YoutubeVideo::published()->orderBy('sort_order')->latest()->get(),
            ]);
    }

    public function single($id)
    {
        $repo = Repo::with('tags', 'pdfFiles', 'authors', 'country')->findOrFail($id);
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
}
