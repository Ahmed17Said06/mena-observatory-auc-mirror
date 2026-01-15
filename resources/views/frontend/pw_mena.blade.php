@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', trans('translation.pw-mena'))

@section('content')
@include('layouts.navbars.guest.navbar', ['title' => 'Future of Work MENA'])

<div class="container" style="min-height: 60vh;">
    <!-- Main Title Section -->
    <div class="mb-5">
        <h1 class="mb-4" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif
            style="text-transform: uppercase; font-size: 3rem;">@lang('translation.pw-mena-title')</h1>

        <div class="d-flex justify-content-between align-items-start gap-5 flex-wrap">
            <div class="text-start flex-grow-1" style="max-width: calc(100% - 30rem);">
                @if($description)
                <p @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif style="color: #333333 !important;">
                    @if(LaravelLocalization::getCurrentLocale() === 'ar')
                    {!! $description->ar_content !!}
                    @else
                    {!! $description->content !!}
                    @endif
                </p>
                @else
                <p @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif style="color: #333333 !important;">
                    Fast and wide-ranging developments in technology have redefined employment relationships around the
                    globe, giving rise to many new forms of work. Platform-mediated work emerged as a way to connect
                    workers to buyers of a labor service— and indeed it has provided millions of individuals around the
                    world with access to work, especially in developing countries— although often at a cost.
                </p>
                <p @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif style="color: #333333 !important;">
                    Our research on platform work in the MENA region aims to influence the global narrative on platform
                    work by giving perspectives from MENA and the larger Global South. By identifying regional
                    opportunities and challenges, we aim to promote inclusive policy making with regards to work and
                    safety nets, and sustainable livelihoods for all.
                </p>
                @endif
            </div>
            <div class="flex-shrink-0" style="margin-left: auto;">
                <img src="{{ asset('img/new_work.png') }}" alt="Future of Work MENA"
                    style="width: 25rem; height: auto; object-fit: contain;">
            </div>
        </div>
    </div>

    <!-- Separation Line -->
    <hr style="border: none; border-top: 2px solid #ccc; margin: 3rem 0; width: 100%; opacity: 1;">

    <!-- Section 1: PW-MENA Network -->
    <div class="mb-5">
        <h2 class="mb-4" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif
            style="color: #022248; font-weight: 700;">
            @lang('translation.pw-mena-network')
        </h2>
        
        <h4 class="mb-4" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif
            style="color: #666;">
            @lang('translation.pw-mena-institutions')
        </h4>
        
        <div class="network-institutions" style="display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center; align-items: center;">
            <!-- Access to Knowledge for Development Center, AUC -->
            <div class="institution-card" style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 12px; min-width: 250px; max-width: 300px;">
                <img src="{{ asset('img/AUCLogo_BUS_A2K4D_blueCMYK_High-01 (1).png') }}" alt="Access to Knowledge for Development Center, AUC" 
                    style="height: 80px; object-fit: contain; margin-bottom: 1rem;">
                <h5 style="font-size: 0.9rem; color: #022248; margin: 0;">Access to Knowledge for Development Center</h5>
                <p style="font-size: 0.8rem; color: #666; margin: 0;">AUC Onsi Sawiris School of Business</p>
            </div>
            
            <!-- The Policy Hub, Lebanon -->
            <div class="institution-card" style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 12px; min-width: 250px; max-width: 300px;">
                <div style="height: 80px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                    <span style="font-size: 2.5rem; color: #022248;">🏛️</span>
                </div>
                <h5 style="font-size: 0.9rem; color: #022248; margin: 0;">The Policy Hub</h5>
                <p style="font-size: 0.8rem; color: #666; margin: 0;">Lebanon</p>
            </div>
            
            <!-- Phenix Center, Jordan -->
            <div class="institution-card" style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 12px; min-width: 250px; max-width: 300px;">
                <div style="height: 80px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                    <span style="font-size: 2.5rem; color: #022248;">🏛️</span>
                </div>
                <h5 style="font-size: 0.9rem; color: #022248; margin: 0;">Phenix Center for Economic and Information Studies</h5>
                <p style="font-size: 0.8rem; color: #666; margin: 0;">Jordan</p>
            </div>
            
            <!-- Tunisia Inclusive Labor Institute -->
            <div class="institution-card" style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 12px; min-width: 250px; max-width: 300px;">
                <div style="height: 80px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                    <span style="font-size: 2.5rem; color: #022248;">🏛️</span>
                </div>
                <h5 style="font-size: 0.9rem; color: #022248; margin: 0;">Tunisia Inclusive Labor Institute</h5>
                <p style="font-size: 0.8rem; color: #666; margin: 0;">Tunisia</p>
            </div>
            
            <!-- The Solidarity Center, Morocco -->
            <div class="institution-card" style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 12px; min-width: 250px; max-width: 300px;">
                <div style="height: 80px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                    <span style="font-size: 2.5rem; color: #022248;">🏛️</span>
                </div>
                <h5 style="font-size: 0.9rem; color: #022248; margin: 0;">The Solidarity Center</h5>
                <p style="font-size: 0.8rem; color: #666; margin: 0;">Morocco</p>
            </div>
        </div>
    </div>

    <!-- Separation Line -->
    <hr style="border: none; border-top: 2px solid #ccc; margin: 3rem 0; width: 100%; opacity: 1;">

    <!-- Section 2: Resources -->
    <div class="mb-5">
        <h2 class="mb-4" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif
            style="color: #022248; font-weight: 700;">
            @lang('translation.pw-mena-resources')
        </h2>

        <!-- Reports -->
        <div class="resource-section mb-5">
            <h3 class="mb-3" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif
                style="color: #FAAF1C; font-weight: 600; border-left: 4px solid #FAAF1C; padding-left: 1rem;">
                @lang('translation.pw-mena-reports')
            </h3>
            <ul class="resource-list" style="list-style: none; padding: 0;" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-pdf" style="color: #FAAF1C;"></i>
                        Cloudwork: Social Protection and Inclusion in the Digital Economy in Egypt
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-pdf" style="color: #FAAF1C;"></i>
                        Platform work, social protection and representation: a case of delivery workers in Egypt
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-pdf" style="color: #FAAF1C;"></i>
                        Social Security Provisions for Workers in the Gig Economy: A Focus on Egypt
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-pdf" style="color: #FAAF1C;"></i>
                        Reaction Note on the Draft Labor Law Regarding the New Forms of Labor
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-pdf" style="color: #FAAF1C;"></i>
                        New Work, Data and Inclusion in the Digital Economy: A Middle East and North Africa Perspective Case Study Jordan
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-pdf" style="color: #FAAF1C;"></i>
                        The perils of digital work in Lebanon: lessons from taxi and delivery workers
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-pdf" style="color: #FAAF1C;"></i>
                        Platform Workers: a Morocco Case Study
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-pdf" style="color: #FAAF1C;"></i>
                        New Forms of Work, Old Forms of Exploitation: An Analysis of Tunisia's Platform and Informal Economies
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-pdf" style="color: #FAAF1C;"></i>
                        Fairwork Egypt 2021: Towards Decent Work in a Highly Informal Economy
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-pdf" style="color: #FAAF1C;"></i>
                        Domestic Platform Work in the Middle East and North Africa
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-pdf" style="color: #FAAF1C;"></i>
                        Fairwork Egypt 2022: Platform Workers Amidst Egypt's Economic Crisis
                    </a>
                </li>
            </ul>
        </div>

        <!-- Policy Briefs -->
        <div class="resource-section mb-5">
            <h3 class="mb-3" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif
                style="color: #FAAF1C; font-weight: 600; border-left: 4px solid #FAAF1C; padding-left: 1rem;">
                @lang('translation.pw-mena-policy-briefs')
            </h3>
            <ul class="resource-list" style="list-style: none; padding: 0;" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-alt" style="color: #022248;"></i>
                        Social protection and representation for delivery workers in Egypt
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-alt" style="color: #022248;"></i>
                        Social Security Provisions for Workers in the Platform Economy: Policy Options with Focus on Egypt
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-alt" style="color: #022248;"></i>
                        Navigating the Digital Frontier: Policy Reforms for Platform Workers in Jordan
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-alt" style="color: #022248;"></i>
                        Precarious freelancing: Lebanon's grim future of work
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-alt" style="color: #022248;"></i>
                        Improving Inclusivity in the Platform Economy
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-alt" style="color: #022248;"></i>
                        Platform Workers in Morocco: a Policy Brief
                    </a>
                </li>
            </ul>
        </div>

        <!-- Blogposts -->
        <div class="resource-section mb-5">
            <h3 class="mb-3" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif
                style="color: #FAAF1C; font-weight: 600; border-left: 4px solid #FAAF1C; padding-left: 1rem;">
                @lang('translation.pw-mena-blogposts')
            </h3>
            <ul class="resource-list" style="list-style: none; padding: 0;" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-blog" style="color: #60a5fa;"></i>
                        Digital Platforms: New Professions in Need of Regulation
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="https://menaobservatory.ai/en/blogs/64" target="_blank" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-blog" style="color: #60a5fa;"></i>
                        New Work: Three Challenges to Protecting Millions of Young Egyptians
                        <i class="fas fa-external-link-alt" style="font-size: 0.7rem; color: #999;"></i>
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-blog" style="color: #60a5fa;"></i>
                        Social Security Provisions for Workers in the Platform Economy: Policy Options with Focus on Egypt
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-blog" style="color: #60a5fa;"></i>
                        Why So Many Platform Economy Jobs are Informal
                    </a>
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <a href="#" style="color: #022248; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-blog" style="color: #60a5fa;"></i>
                        The Flexibility and Desperation of Platform Work in Tunisia
                    </a>
                </li>
            </ul>
        </div>

        <!-- Visuals -->
        <div class="resource-section mb-5">
            <h3 class="mb-3" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif
                style="color: #FAAF1C; font-weight: 600; border-left: 4px solid #FAAF1C; padding-left: 1rem;">
                @lang('translation.pw-mena-visuals')
            </h3>
            <div class="visuals-placeholder" style="background: #f8f9fa; border-radius: 12px; padding: 3rem; text-align: center; color: #999;">
                <i class="fas fa-images" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                <p>Visuals content coming soon</p>
            </div>
        </div>
    </div>

    <!-- Separation Line -->
    <hr style="border: none; border-top: 2px solid #ccc; margin: 3rem 0; width: 100%; opacity: 1;">

    <!-- Section 3: Relevant Posts -->
    <div class="mb-5">
        <h2 class="mb-4" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif
            style="color: #022248; font-weight: 700;">
            @lang('translation.pw-mena-relevant-posts')
        </h2>
        
        @if($relatedPosts && $relatedPosts->count() > 0)
        <div class="lazy-items-container" style='overflow: hidden; display: flex; flex-wrap: wrap; justify-content: center;'>
            @foreach($relatedPosts as $post)
            <div class="post-container lazy-item">
                <div class="post-loop position-relative overflow-hidden">
                    <img class="post-img" src="{{Storage::url($post->image)}}">
                    <div class="post-content" lang="en">
                        <h4 style='color:#FFF;' class='slide_title'>
                            <a href='{{route("blogs.single", ["id" => $post->id])}}'>{{$post->title}}</a>
                        </h4>
                        <p style='color:#FFF;' class='slide_description'>
                            {{ Str::limit(strip_tags($post->description), 80) }}</p>
                        <a href='{{route("blogs.single", ["id" => $post->id])}}'>
                            <button class='btn learn_more'><i class="fas fa-plus"></i> Read More</button>
                        </a>
                    </div>
                    <div class="overlay-1"></div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="no-posts" style="background: #f8f9fa; border-radius: 12px; padding: 3rem; text-align: center; color: #999;">
            <i class="fas fa-newspaper" style="font-size: 3rem; margin-bottom: 1rem;"></i>
            <p>No related posts available yet. Check back soon!</p>
        </div>
        @endif
    </div>
</div>

<style>
    .resource-list li a:hover {
        color: #FAAF1C !important;
        transform: translateX(5px);
        transition: all 0.3s ease;
    }
    
    .institution-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .institution-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    @media (max-width: 768px) {
        .network-institutions {
            flex-direction: column;
            align-items: center;
        }
        
        .institution-card {
            width: 100%;
            max-width: 100% !important;
        }
        
        .d-flex.justify-content-between {
            flex-direction: column;
        }
        
        .text-start.flex-grow-1 {
            max-width: 100% !important;
        }
        
        .flex-shrink-0 {
            display: none;
        }
    }
</style>

@include('layouts.footers.guest.footer')
@endsection