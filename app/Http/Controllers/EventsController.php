<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;

class EventsController extends Controller
{
    public function single($id)
    {
        $event = Events::query()->with('tags')->findOrFail($id);
        $event->views+=1;
        $event->save();
        $tagIds = $event->tags->pluck('id');

        $relatedEvents = Events::whereHas('tags', function ($query) use ($tagIds) {
            $query->whereIn('repo_tags.id', $tagIds);
        })
            ->where('events.id', '!=', $event->id)
            ->get();

        $relatedEvents = $relatedEvents->map(function ($blog) use ($tagIds) {
            $commonTagsCount = $blog->tags->whereIn('id', $tagIds)->count();

            // Add the count to the blog post model.
            $blog->common_tags_count = $commonTagsCount;

            return $blog;
        });

        // Sort the blog posts by the count of shared tags in descending order.
        $relatedEvents = $relatedEvents->sortByDesc('common_tags_count');

        // Take the top 3 blog posts.
        $relatedEvents = $relatedEvents->take(3);
        return view('frontend.event-single')->with([
            'event' => $event,
            'relatedEvents' => $relatedEvents
        ]);
    }

    public function js_list_view(request $request)
    {
        $events = Events::where('title', 'like', $request->get('term') . '%')
            ->paginate(3);
        return response()->json([
            'success' => true,
            'html' => view('frontend.components.events_list')->with(['events' => $events])->render()
        ]);

    }

}
