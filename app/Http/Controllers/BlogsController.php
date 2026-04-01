<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;

class BlogsController extends Controller
{
    public function index()
    {
        $blogs = Blogs::orderBy('publish_date', 'desc')->get();

        return view('frontend.blogs')->with([
            'blogs' => $blogs
        ]);
    }


    public function js_list_view(request $request)
    {
        $blogs = Blogs::whereRaw('lower(title) like (?)', ["%{$request->get('term')}%"])
            ->orderBy('publish_date', 'desc')
            ->paginate(6);
        return response()->json([
            'success' => true,
            'html' => view('frontend.components.blogs')->with(['blogs' => $blogs])->render()
        ]);

    }

    public function single($id)
    {
        $blog = Blogs::where('id', $id)->with('tags')->firstOrFail();
        $blog->views += 1;
        $blog->save();
        $tagIds = $blog->tags->pluck('id');

        $relatedBlogs = Blogs::whereHas('tags', function ($query) use ($tagIds) {
            $query->whereIn('repo_tags.id', $tagIds);
        })
            ->where('blogs.id', '!=', $blog->id)
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
        return view('frontend.blogs-single')->with([
            'blog' => $blog,
            'relatedBlogs' => $relatedBlogs
        ]);
    }


}
