<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Report;

class NewWorkReports extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $reports = Report::published()
            ->orderBy('published_at', 'desc')
            ->paginate(3, ['*'], 'reportsPage');

        return view('livewire.new-work-reports', [
            'reports' => $reports
        ]);
    }
}