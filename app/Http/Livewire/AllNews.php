<?php

namespace App\Http\Livewire;

use App\Models\News;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AllNews extends Component
{
    public $search = '';

    // Lazy loading properties
    public $pageNumber = 1;
    public $perPage = 6;
    public $hasMorePages = true;
    
    // Static RAI Cup article data
    private function getStaticRaiCupArticle()
    {
        $isArabic = LaravelLocalization::getCurrentLocale() === 'ar';
        
        return (object) [
            'id' => 'rai-cup-2026',
            'is_static' => true,
            'title' => $isArabic 
                ? 'الجامعة الأمريكية بالقاهرة تستضيف حفل ختام كأس الذكاء الاصطناعي المسؤول تحت رعاية وزارة الاتصالات وتكنولوجيا المعلومات'
                : 'The Access to Knowledge for Development Center at The American University in Cairo Hosts the Responsible AI Cup Awards Ceremony',
            'description' => $isArabic
                ? 'سيستضيف مركز إتاحة المعرفة من أجل التنمية (A2K4D) بكلية أنسي ساويرس لإدارة الأعمال بالجامعة الأمريكية بالقاهرة حفل ختام النسخة الأولى من مسابقة كأس الذكاء الاصطناعي المسؤول يوم الأحد 18 يناير 2026.'
                : 'The American University in Cairo (AUC) represented by Access to Knowledge for Development (A2K4D) will host the Inaugural Responsible AI Cup Awards Ceremony on Sunday, January 18, 2026.',
            'image' => 'img/news/rai-cup-ceremony.jpg', // still from the ceremony video
            'date' => '2026-01-18',
            'created_at' => now(),
        ];
    }

    public function updateSearch()
    {
        $this->pageNumber = 1;
    }

    private function getQuery()
    {
        // Curated "Global AI News" items (featured='global_ai') have their own
        // section on the news page, so exclude them here to avoid duplication.
        return News::where('title', 'like', '%' . $this->search . '%')
            ->where(function ($q) {
                $q->where('featured', '!=', 'global_ai')
                  ->orWhereNull('featured');
            })
            // Earliest first, by the item's own date (or when it was added,
            // if it has none); id keeps same-day items in a stable order.
            ->orderByRaw('COALESCE(`date`, `created_at`)')
            ->orderBy('id');
    }

    /** The date a news item sorts by, matching getQuery()'s ordering. */
    private function sortDate($n): string
    {
        return substr((string) ($n->date ?: $n->created_at), 0, 10);
    }

    public function loadMore(): void
    {
        $this->pageNumber++;
    }

    public function render()
    {
        // Rebuild the full visible list from scalar state each render so we
        // never persist (and serialize) model objects across Livewire
        // requests — that is what turned items into arrays on "load more".
        $total = $this->perPage * $this->pageNumber;
        $paginated = $this->getQuery()->paginate($total, ['*'], 'page', 1);

        $this->hasMorePages = $paginated->hasMorePages();

        $blogs = collect($paginated->items());

        // Slot the static RAI Cup article in by its date (when not searching),
        // once the loaded items reach that date, so "load more" only ever
        // appends and never reshuffles what is already on screen.
        if (empty($this->search)) {
            $raiCup = $this->getStaticRaiCupArticle();
            $last = $blogs->last();
            if (!$this->hasMorePages || ($last && $this->sortDate($last) >= $raiCup->date)) {
                $blogs = $blogs->push($raiCup)->sortBy(fn ($n) => $this->sortDate($n))->values();
            }
        }

        return view('livewire.news', ['blogs' => $blogs]);
    }
}

