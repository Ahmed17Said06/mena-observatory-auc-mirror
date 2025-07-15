<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PolicyBrief;

class NewWorkPolicyBriefs extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // Show all policy briefs, or only published ones that have a date
        $policyBriefs = PolicyBrief::where(function($query) {
                $query->whereNotNull('published_at')
                      ->where('published_at', '<=', now());
            })
            ->orWhereNull('published_at') // Include unpublished ones for now
            ->orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(3, ['*'], 'briefsPage');

        return view('livewire.new-work-policy-briefs', [
            'policyBriefs' => $policyBriefs
        ]);
    }
}