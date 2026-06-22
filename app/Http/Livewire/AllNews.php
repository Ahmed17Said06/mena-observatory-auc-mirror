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
            'image' => 'img/AUCLogo_BUS_A2K4D_blueCMYK_High-01 (1).png',
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
            ->orderBy('created_at', 'desc');
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

        // Pin the static RAI Cup article to the top (when not searching).
        if (empty($this->search)) {
            $blogs = collect([$this->getStaticRaiCupArticle()])->merge($blogs);
        }

        return view('livewire.news', ['blogs' => $blogs]);
    }
}

