<?php

namespace App\Http\Livewire;

use App\Models\News;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AllNews extends Component
{
    public Collection $blogs;
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

    public function mount()
    {
        $this->blogs = new Collection();
        $this->loadMore();
    }

    public function updateSearch()
    {
        $this->resetItems();
    }
    
    private function getQuery()
    {
        return News::where('title', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc');
    }
    
    public function loadMore(): void
    {
        $paginated = $this->getQuery()->paginate($this->perPage, ['*'], 'page', $this->pageNumber);
        
        $this->pageNumber++;
        $this->hasMorePages = $paginated->hasMorePages();
        
        // Append new items to the collection
        $newItems = collect($paginated->items());
        
        // Add static RAI Cup article at the beginning of first page only (if not searching)
        if ($this->pageNumber === 2 && empty($this->search)) {
            $staticArticle = $this->getStaticRaiCupArticle();
            $newItems = collect([$staticArticle])->merge($newItems);
        }
        
        $this->blogs = $this->blogs->merge($newItems);
    }
    
    private function resetItems(): void
    {
        $this->blogs = new Collection();
        $this->pageNumber = 1;
        $this->hasMorePages = true;
        $this->loadMore();
    }

    public function render()
    {
        return view('livewire.news');
    }
}
