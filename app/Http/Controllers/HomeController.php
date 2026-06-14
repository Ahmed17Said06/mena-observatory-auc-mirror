<?php

namespace App\Http\Controllers;

use App\Models\Aswat;
use App\Models\Blogs;
use App\Models\Events;
use App\Models\FeaturedPost;
use App\Models\GenderAi;
use App\Models\News;
use App\Models\Partner;
use App\Models\Repo;
use App\Models\static_content;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class HomeController extends Controller
{

    public function paginate($items, $perPage = 15, $page = null, $options = []): LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }


    public function index()
    {
        $featuredPosts = FeaturedPost::query()->latest()->take(3)->get();
        $events = Events::select('id', 'title', 'description', 'created_at', 'image')->where('featured', 'yes')->orderBy('created_at', 'desc')->get();
        $news = News::select('id', 'title', 'description', 'created_at', 'image')->where('featured', 'yes')->orderBy('created_at', 'desc')->get();

        $news_events = $news->concat($events)->sortByDesc('created_at')->take(3);
        return view('frontend.home')->with([
            'news_events' => $news_events,
            'event',
            // 'featuredPosts' => $featuredPosts,
            'intro' => static_content::where('key', 'Intro')->first(),
            // 'blogs' => Blogs::latest()->take(3)->get(),
        //    'aswats' => Aswat::latest()->paginate(3),
            // 'gender_ai' => GenderAi::latest()->take(3)->get()
        ]);
    }

    public function comingSoon()
    {
        $events = Events::where('featured', 'yes')->get();
        $news = News::where('featured', 'yes')->get();

        $ne = [];
        foreach ($news as $newse)
            $ne[] = $newse;
        foreach ($events as $event)
            $ne[] = $event;
        $news_events = $ne;
        usort($news_events, function ($a, $b) {
            return strcmp($a->created_at, $b->created_at);
        });
        return view('frontend.coming-soon')->with([
            'news_events' => $news_events,
            'event',
            'intro' => static_content::where('key', 'Intro')->first(),
            'blogs' => Blogs::take(3)->get()
        ]);
    }

    public function about_us()
    {
        return view('frontend.about_us')->with([
            'partners' => Partner::all(),

            'intro' => static_content::where('key', 'About Us Intro')->first(),
            'video_content' => static_content::where('key', 'about_video_content')->first(),
            'story' => static_content::where('key', 'Our Story')->first(),
            'vision' => static_content::where('key', 'vision')->first(),
            'objective_1' => static_content::where('key', 'Objective - 1')->first(),
            'objective_2' => static_content::where('key', 'Objective - 2')->first(),
            'objective_3' => static_content::where('key', 'Objective - 3')->first(),
            'objective_4' => static_content::where('key', 'Objective - 4')->first(),
            'objective_5' => static_content::where('key', 'Objective - 5')->first(),
//            'partners_intro' => static_content::where('key', 'Partners Intro')->first(),
        ]);

    }

    public function contact_us()
    {
        return view('frontend.contact_us')->with([
            'intro' => static_content::where('key', 'Contact Us Intro')->first(),
        ]);
    }

    public function collaborate()
    {
        return view('frontend.collaborate')->with([
            'intro' => static_content::where('key', 'Contact Us Intro')->first(),
            'find_partners' => static_content::where('key', 'find-partners')->first(),
            'share_relevant' => static_content::where('key', 'share-relevant')->first(),
            'share_work' => static_content::where('key', 'share-work')->first(),
            'want_to_work' => static_content::where('key', 'want_to_work')->first(),
            'want_share_event' => static_content::where('key', 'want_share_event')->first(),
            'want_share_work' => static_content::where('key', 'want_share_work')->first(),
            'footer_collaboration' => static_content::where('key', 'footer_collaboration')->first(),
            'header_collaboration' => static_content::where('key', 'header_collaboration')->first(),
        ]);
    }

    public function aiIndices()
    {
        return view('frontend.ai_indices')->with([
            'intro' => static_content::where('key', 'AI Indices Intro')->first(),
        ]);
    }

    public function podcasts()
    {
        return view('frontend.podcasts');
    }


    public function news_events()
    {
        return view('frontend.news_events')->with([
            'news' => News::all(),
        ]);
    }


    public function blogs()
    {
        return view('frontend.blogs')->with([
            'blogs' => Blogs::all(),
        ]);
    }

    public function new_work()
    {
        return view('frontend.new_work')->with([
            'new_work' => News::all(),
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $tag = $request->input('tag');

        // Group the search OR-conditions so they don't break the tag AND-filter (operator precedence).
        $blogs = Blogs::query()->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        })
            ->when($tag, function ($query) use ($tag) {
                $query->whereHas('tags', function ($query) use ($tag) {
                    $query->where('repo_tags.name', $tag);
                });
            })->latest()->take(3)->get();
        $news = News::query()->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        })->when($tag, function ($query) use ($tag) {
            $query->whereHas('tags', function ($query) use ($tag) {
                $query->where('repo_tags.name', $tag);
            });
        })->latest()->take(3)->get();
        $events = Events::query()->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        })->when($tag, function ($query) use ($tag) {
            $query->whereHas('tags', function ($query) use ($tag) {
                $query->where('repo_tags.name', $tag);
            });
        })->latest()->take(3)->get();

        $projects = Repo::query()->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        })->when($tag, function ($query) use ($tag) {
            $query->whereHas('tags', function ($query) use ($tag) {
                $query->where('repo_tags.name', $tag);
            });
        })->latest()->take(3)->get();
        $count = count($blogs) + count($news) + count($events) + count($projects);

        $request->flash();

        return view('frontend.search', compact('blogs', 'news', 'events', 'count', 'projects'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        \App\Models\Subscriber::create(['email' => $request->email]);

        return redirect()->back()->with('subscribe_success', 'Thank you for subscribing!');
    }
}
