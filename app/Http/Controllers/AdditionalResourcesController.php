<?php

namespace App\Http\Controllers;

use App\Models\AdditionalResource;
use Illuminate\Http\Request;

class AdditionalResourcesController extends Controller
{
    public function single($id)
    {
        $resource = AdditionalResource::with('tags')->findOrFail($id);
        $resource->views += 1;
        $resource->save();
        $tagIds = $resource->tags->pluck('id');

        $relatedResources = AdditionalResource::whereHas('tags', function ($query) use ($tagIds) {
            $query->whereIn('repo_tags.id', $tagIds);
        })
            ->where('additional_resources.id', '!=', $resource->id)
            ->get();

        $relatedResources = $relatedResources->map(function ($relatedResource) use ($tagIds) {
            $commonTagsCount = $relatedResource->tags->whereIn('id', $tagIds)->count();
            $relatedResource->common_tags_count = $commonTagsCount;

            return $relatedResource;
        });

        $relatedResources = $relatedResources->sortByDesc('common_tags_count');
        $relatedResources = $relatedResources->take(3);

        return view('frontend.resources-single')->with([
            'resource' => $resource,
            'relatedResources' => $relatedResources
        ]);
    }

}
