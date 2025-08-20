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

    public function blogs()
    {
        $newWorkBlogs = NewWorkBlog::published()->orderBy('publish_date', 'desc')->paginate(6);
        $description = static_content::where('key', 'new_work_description')->first();

        return view('frontend.new-work-blogs')->with([
            'newWorkBlogs' => $newWorkBlogs,
            'description' => $description
        ]);
    }

    public function blogsHtmlList()
    {
        $newWorkBlogs = NewWorkBlog::published()->orderBy('publish_date', 'desc')->paginate(3);
        
        return view('livewire.new-work-blogs', [
            'newWorkBlogs' => $newWorkBlogs
        ])->render();
    }

    public function policyBriefs()
    {
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

    public function newWorkBlogSingle($id)
    {
        $blog = NewWorkBlog::where('id', $id)->with('tags')->firstOrFail();
        $blog->views += 1;
        $blog->save();
        $tagIds = $blog->tags->pluck('id');

        $relatedBlogs = NewWorkBlog::whereHas('tags', function ($query) use ($tagIds) {
            $query->whereIn('repo_tags.id', $tagIds);
        })
            ->where('new_work_blogs.id', '!=', $blog->id)
            ->get();

        $relatedBlogs = $relatedBlogs->map(function ($blog) use ($tagIds) {
            $commonTagsCount = $blog->tags->whereIn('id', $tagIds)->count();

            // Add the count to the blog post model.
            $blog->common_tags_count = $commonTagsCount;

            return $blog;
        });

        // Sort the blog posts by the count of shared tags in descending order.
        $relatedBlogs = $relatedBlogs->sortByDesc('common_tags_count');

        // Take the top 3 blog posts.
        $relatedBlogs = $relatedBlogs->take(3);
        
        return view('frontend.new-work-blog-single')->with([
            'blog' => $blog,
            'relatedBlogs' => $relatedBlogs
        ]);
    }
}
