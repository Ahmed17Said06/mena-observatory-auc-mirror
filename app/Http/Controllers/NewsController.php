<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\static_content;

class NewsController extends Controller
{
    public function single($id)
    {
        $news = News::query()->with('tags')->findOrFail($id);
        $news->views += 1;
        $news->save();

        // If the entry has an external link, redirect straight there
        if ($news->data_link) {
            return redirect()->away($news->data_link);
        }
        $tagIds = $news->tags->pluck('id');

        $relatedNews = News::whereHas('tags', function ($query) use ($tagIds) {
            $query->whereIn('repo_tags.id', $tagIds);
        })
            ->where('news.id', '!=', $news->id)
            ->get();

        $relatedNews = $relatedNews->map(function ($blog) use ($tagIds) {
            $commonTagsCount = $blog->tags->whereIn('id', $tagIds)->count();

            // Add the count to the blog post model.
            $blog->common_tags_count = $commonTagsCount;

            return $blog;
        });

        // Sort the blog posts by the count of shared tags in descending order.
        $relatedNews = $relatedNews->sortByDesc('common_tags_count');

        // Take the top 3 blog posts.
        $relatedNews = $relatedNews->take(3);
        return view('frontend.news-single')->with([
            'news' => $news,
            'relatedNews' => $relatedNews
        ]);
    }

    public function js_list_view()
    {
        return response()->json([
            'success' => true,
            'html' => view('frontend.components.news_slider')->with(['news' => News::paginate(3)])->render()
        ]);

    }

    public function news()
    {
        $keys = [
            'news_card_1_title', 'news_card_1_desc',
            'news_card_2_title', 'news_card_2_desc',
            'news_card_3_title', 'news_card_3_desc', 'news_card_3_link', 'news_card_3_btn',
        ];
        $sc = static_content::whereIn('key', $keys)->get()->keyBy('key');
        return view('frontend.news', ['sc' => $sc]);
    }

    public function raiCup()
    {
        return view('frontend.news-rai-cup');
    }

}
