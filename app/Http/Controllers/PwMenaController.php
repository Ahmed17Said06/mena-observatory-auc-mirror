<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\PwMenaPublication;
use App\Models\Repo;
use App\Models\static_content;
use Illuminate\Http\Request;

class PwMenaController extends Controller
{
    public function index()
    {
        // Batch-load all static content for this page
        $keys = [
            'pw_mena_description',
            'pw_mena_disclaimer',
            'pw_mena_inst_auc_name', 'pw_mena_inst_auc_org',
            'pw_mena_inst_policy_hub_name', 'pw_mena_inst_policy_hub_org',
            'pw_mena_inst_phenix_name', 'pw_mena_inst_phenix_org',
            'pw_mena_inst_tunisia_name', 'pw_mena_inst_tunisia_org',
            'pw_mena_inst_solidarity_name', 'pw_mena_inst_solidarity_org',
        ];
        $sc = static_content::whereIn('key', $keys)->get()->keyBy('key');

        // Keep $description for backward compatibility with existing blade code
        $description = $sc->get('pw_mena_description');

        // Get related blogs tagged with platform work (if available)
        $relatedPosts = Blogs::whereHas('tags', function ($query) {
            $query->where('name', 'like', '%platform%')
                ->orWhere('name', 'like', '%work%')
                ->orWhere('name', 'like', '%gig%');
        })->latest()->take(3)->get();

        try {
            $reports     = PwMenaPublication::reports()->orderBy('sort_order')->get();
            $briefs      = PwMenaPublication::briefs()->orderBy('sort_order')->get();
            $blogs       = PwMenaPublication::blogs()->orderBy('sort_order')->get();
            $pubWebinars = PwMenaPublication::webinars()->orderBy('sort_order')->get();
            $pubEdu      = PwMenaPublication::educational()->orderBy('sort_order')->get();
        } catch (\Exception $e) {
            $reports     = collect();
            $briefs      = collect();
            $blogs       = collect();
            $pubWebinars = collect();
            $pubEdu      = collect();
        }

        $fowTag = 'fow';
        $repoWebinars  = Repo::whereHas('tags', fn($q) => $q->where('name', $fowTag))
                             ->where('is_talk_webinar', true)->latest()->get();
        $repoEdu       = Repo::whereHas('tags', fn($q) => $q->where('name', $fowTag))
                             ->where('is_educational', true)->latest()->get();
        $regionalRepos = Repo::whereHas('tags', fn($q) => $q->where('name', $fowTag))
                             ->where('is_our_work', false)
                             ->where(fn($q) => $q->where('is_global', false)->orWhereNull('is_global'))
                             ->latest()->get();
        $globalRepos   = Repo::whereHas('tags', fn($q) => $q->where('name', $fowTag))
                             ->where('is_our_work', false)
                             ->where('is_global', true)->latest()->get();

        return view('frontend.pw_mena')->with([
            'description'  => $description,
            'sc'           => $sc,
            'relatedPosts' => $relatedPosts,
            'reports'      => $reports,
            'briefs'       => $briefs,
            'blogs'        => $blogs,
            'pubWebinars'  => $pubWebinars,
            'pubEdu'       => $pubEdu,
            'repoWebinars' => $repoWebinars,
            'repoEdu'      => $repoEdu,
            'regionalRepos'=> $regionalRepos,
            'globalRepos'  => $globalRepos,
        ]);
    }
}
