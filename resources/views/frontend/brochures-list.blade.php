@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>#map_outer { display:none !important; }</style>

@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Brochures'])

    <div class="container my-4 my-lg-5" @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
        <div class="row mb-4">
            <div class="col-12">
                <h2 style="color:#022448; font-weight:800; margin-bottom:0.25rem;">
                    @if(LaravelLocalization::getCurrentLocale() === 'ar') كتيبات المرصد @else Brochures @endif
                </h2>
                <div style="width:40px; height:3px; background:#c8870a; border-radius:2px; margin-bottom:0.75rem;"></div>
                <p style="color:#6b7280;">
                    @if(LaravelLocalization::getCurrentLocale() === 'ar')
                        تصفح كتيبات ومطبوعات مرصد الشرق الأوسط وشمال أفريقيا للذكاء الاصطناعي المسؤول
                    @else
                        Publications and brochures from the MENA Observatory on Responsible AI.
                    @endif
                </p>
            </div>
        </div>

        @if($brochures->count() > 0)
            <div class="row g-4">
                @foreach($brochures as $brochure)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="brochure-card">
                            @if($brochure->image)
                                <div class="brochure-cover">
                                    <img src="{{ Storage::url($brochure->image) }}"
                                         alt="{{ $brochure->title }}"
                                         onerror="this.src='/img/placeholder-featured.jpg'">
                                </div>
                            @else
                                <div class="brochure-cover brochure-cover--placeholder">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#c8870a" stroke-width="1.5">
                                        <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="brochure-info">
                                <h3 class="brochure-title">
                                    @if(LaravelLocalization::getCurrentLocale() === 'ar' && $brochure->ar_title)
                                        {{ $brochure->ar_title }}
                                    @else
                                        {{ $brochure->title }}
                                    @endif
                                </h3>
                                @if($brochure->description || $brochure->ar_description)
                                    <p class="brochure-desc">
                                        {{ LaravelLocalization::getCurrentLocale() === 'ar' && $brochure->ar_description
                                            ? \Illuminate\Support\Str::limit($brochure->ar_description, 120)
                                            : \Illuminate\Support\Str::limit($brochure->description, 120) }}
                                    </p>
                                @endif
                                <div class="brochure-actions">
                                    <a href="{{ route('brochure.show', $brochure->slug) }}" class="brochure-btn-view">
                                        @if(LaravelLocalization::getCurrentLocale() === 'ar') عرض @else View @endif
                                    </a>
                                    @if($brochure->pdf_file)
                                        <a href="{{ Storage::url($brochure->pdf_file) }}" target="_blank" class="brochure-btn-dl">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                <path d="M12 16l-4-4m4 4l4-4m-4 4V4M4 20h16"/>
                                            </svg>
                                            PDF
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5" style="color:#9ca3af;">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                     style="margin-bottom:1rem; opacity:.4;">
                    <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                </svg>
                <h5>No brochures published yet.</h5>
            </div>
        @endif
    </div>

    @include('layouts.footers.guest.footer')

    <style>
        .brochure-card {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,.07);
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .brochure-card:hover { transform: translateY(-4px); box-shadow: 0 8px 28px rgba(0,0,0,.12); }
        .brochure-cover { height: 220px; overflow: hidden; }
        .brochure-cover img { width: 100%; height: 100%; object-fit: cover; }
        .brochure-cover--placeholder {
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .brochure-info { padding: 1.25rem; flex: 1; display: flex; flex-direction: column; }
        .brochure-title { font-size: 1rem; font-weight: 700; color: #022448; margin-bottom: 0.5rem; }
        .brochure-desc { font-size: 0.88rem; color: #6b7280; line-height: 1.6; flex: 1; margin-bottom: 1rem; }
        .brochure-actions { display: flex; gap: 0.5rem; align-items: center; }
        .brochure-btn-view {
            font-size: 0.85rem; color: #022448; font-weight: 600;
            text-decoration: none; padding: 6px 16px;
            border: 1.5px solid #022448; border-radius: 20px;
            transition: background 0.2s, color 0.2s;
        }
        .brochure-btn-view:hover { background: #022448; color: #fff; }
        .brochure-btn-dl {
            font-size: 0.85rem; color: #fff; font-weight: 600;
            text-decoration: none; padding: 6px 14px;
            background: #c8870a; border-radius: 20px;
            display: inline-flex; align-items: center; gap: 5px;
            transition: background 0.2s;
        }
        .brochure-btn-dl:hover { background: #a86f08; color: #fff; }
    </style>
@endsection
