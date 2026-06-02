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

    <!-- CTA to Knowledge Hub -->
    <div class="mt-4 mb-2">
        <a href="{{ route('pw_mena.resources') }}"
           style="display:inline-block; padding:.75rem 1.75rem; background:#FAAF1C; color:#022248; border-radius:50px; font-weight:700; font-size:.95rem; text-decoration:none; transition:all .3s ease; border:2px solid #FAAF1C;"
           onmouseover="this.style.background='#e09a10';this.style.borderColor='#e09a10';"
           onmouseout="this.style.background='#FAAF1C';this.style.borderColor='#FAAF1C';">
            Explore Knowledge Hub
        </a>
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
        
        @php
            $instAucName       = $sc->get('pw_mena_inst_auc_name');
            $instAucOrg        = $sc->get('pw_mena_inst_auc_org');
            $instPolicyName    = $sc->get('pw_mena_inst_policy_hub_name');
            $instPolicyOrg     = $sc->get('pw_mena_inst_policy_hub_org');
            $instPhenixName    = $sc->get('pw_mena_inst_phenix_name');
            $instPhenixOrg     = $sc->get('pw_mena_inst_phenix_org');
            $instTunisiaName   = $sc->get('pw_mena_inst_tunisia_name');
            $instTunisiaOrg    = $sc->get('pw_mena_inst_tunisia_org');
            $instSolidName     = $sc->get('pw_mena_inst_solidarity_name');
            $instSolidOrg      = $sc->get('pw_mena_inst_solidarity_org');
        @endphp
        <div class="network-institutions" style="display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center; align-items: center;">
            <!-- Access to Knowledge for Development Center, AUC -->
            <div class="institution-card" style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 12px; min-width: 250px; max-width: 300px;">
                <img src="{{ asset('img/AUCLogo_BUS_A2K4D_blueCMYK_High-01 (1).png') }}" alt="Access to Knowledge for Development Center, AUC"
                    style="height: 80px; object-fit: contain; margin-bottom: 1rem;">
                <h5 style="font-size: 0.9rem; color: #022248; margin: 0;">
                    @if($instAucName){{ $instAucName->content }}@else Access to Knowledge for Development Center @endif
                </h5>
                <p style="font-size: 0.8rem; color: #666; margin: 0;">
                    @if($instAucOrg){{ $instAucOrg->content }}@else AUC Onsi Sawiris School of Business @endif
                </p>
            </div>

            <!-- The Policy Hub, Lebanon -->
            <div class="institution-card" style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 12px; min-width: 250px; max-width: 300px;">
                <div style="height: 80px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                    <span style="font-size: 2.5rem; color: #022248;">🏛️</span>
                </div>
                <h5 style="font-size: 0.9rem; color: #022248; margin: 0;">
                    @if($instPolicyName){{ $instPolicyName->content }}@else The Policy Hub @endif
                </h5>
                <p style="font-size: 0.8rem; color: #666; margin: 0;">
                    @if($instPolicyOrg){{ $instPolicyOrg->content }}@else Lebanon @endif
                </p>
            </div>

            <!-- Phenix Center, Jordan -->
            <div class="institution-card" style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 12px; min-width: 250px; max-width: 300px;">
                <div style="height: 80px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                    <span style="font-size: 2.5rem; color: #022248;">🏛️</span>
                </div>
                <h5 style="font-size: 0.9rem; color: #022248; margin: 0;">
                    @if($instPhenixName){{ $instPhenixName->content }}@else Phenix Center for Economic and Information Studies @endif
                </h5>
                <p style="font-size: 0.8rem; color: #666; margin: 0;">
                    @if($instPhenixOrg){{ $instPhenixOrg->content }}@else Jordan @endif
                </p>
            </div>

            <!-- Tunisia Inclusive Labor Institute -->
            <div class="institution-card" style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 12px; min-width: 250px; max-width: 300px;">
                <div style="height: 80px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                    <span style="font-size: 2.5rem; color: #022248;">🏛️</span>
                </div>
                <h5 style="font-size: 0.9rem; color: #022248; margin: 0;">
                    @if($instTunisiaName){{ $instTunisiaName->content }}@else Tunisia Inclusive Labor Institute @endif
                </h5>
                <p style="font-size: 0.8rem; color: #666; margin: 0;">
                    @if($instTunisiaOrg){{ $instTunisiaOrg->content }}@else Tunisia @endif
                </p>
            </div>

            <!-- The Solidarity Center, Morocco -->
            <div class="institution-card" style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 12px; min-width: 250px; max-width: 300px;">
                <div style="height: 80px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                    <span style="font-size: 2.5rem; color: #022248;">🏛️</span>
                </div>
                <h5 style="font-size: 0.9rem; color: #022248; margin: 0;">
                    @if($instSolidName){{ $instSolidName->content }}@else The Solidarity Center @endif
                </h5>
                <p style="font-size: 0.8rem; color: #666; margin: 0;">
                    @if($instSolidOrg){{ $instSolidOrg->content }}@else Morocco @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Separation Line -->
    <hr style="border: none; border-top: 2px solid #ccc; margin: 3rem 0; width: 100%; opacity: 1;">

    <!-- Section 2: Observatory Outputs -->
    <div class="mb-5">
        <h2 class="mb-1" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif
            style="color: #022248; font-weight: 700;">
            Observatory Outputs
        </h2>
        <p class="mb-4" style="color:#6b7280; font-size:.9rem;">Research, Webinars &amp; Talks, and Educational Resources produced by the team.</p>

        <!-- a. Research -->
        <div class="pw-subsec mb-4">
            <h3 class="pw-subsec__heading" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif>
                <span class="pw-subsec__letter">a</span> Research
            </h3>
        </div>

        <!-- Reports -->
        <div class="resource-section mb-5">
            <h3 class="mb-3" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif
                style="color: #FAAF1C; font-weight: 600; border-left: 4px solid #FAAF1C; padding-left: 1rem;">
                @lang('translation.pw-mena-reports')
            </h3>
            <!-- Disclaimer -->
            <div class="disclaimer-box mb-4" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif
                style="background: #fff8e6; border-left: 4px solid #FAAF1C; padding: 1rem 1.5rem; border-radius: 0 8px 8px 0; font-size: 0.9rem; color: #666;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="#FAAF1C" style="margin-right: 0.5rem; flex-shrink: 0; vertical-align: middle;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                @php $disclaimer = $sc->get('pw_mena_disclaimer') @endphp
                @if($disclaimer)
                    {!! LaravelLocalization::getCurrentLocale() === 'ar' && $disclaimer->ar_content ? $disclaimer->ar_content : $disclaimer->content !!}
                @elseif(LaravelLocalization::getCurrentLocale() === 'ar')
                    <strong>ملاحظة:</strong> تم إجراء العمل الميداني لهذه التقارير في خريف/شتاء 2023. يستند التحليل والتوصيات إلى هذا الجدول الزمني.
                @else
                    <strong>Note:</strong> Fieldwork for these reports was conducted in Fall/Winter 2023. Analysis and recommendations are based on that timeline.
                @endif
            </div>
            <div class="resource-cards-grid" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif>
                @if($reports->isNotEmpty())
                    {{-- Dynamic reports from DB --}}
                    @foreach($reports as $pub)
                        @php
                            $isAr      = LaravelLocalization::getCurrentLocale() === 'ar';
                            $pubTitle  = ($isAr && $pub->ar_title) ? $pub->ar_title : $pub->title;
                            $hasLangs  = $pub->link_ar || $pub->link_fr;
                            $singleUrl = !$hasLangs ? ($pub->link_en_url ?? $pub->external_url) : null;
                        @endphp
                        @if($singleUrl)
                            <a href="{{ $singleUrl }}" target="_blank" class="resource-card resource-card--report">
                                <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                                <div class="resource-card__title">{{ $pubTitle }}</div>
                                @if($pub->description)<p class="resource-card__desc">{{ $pub->description }}</p>@endif
                                @if($pub->tag)<div class="resource-card__tag">{{ $pub->tag }}</div>@endif
                                <span class="resource-card__external">@include('frontend.partials._icon-external')</span>
                            </a>
                        @else
                            <div class="resource-card resource-card--report">
                                <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                                <div class="resource-card__title">{{ $pubTitle }}</div>
                                @if($pub->description)<p class="resource-card__desc">{{ $pub->description }}</p>@endif
                                @if($pub->tag)<div class="resource-card__tag">{{ $pub->tag }}</div>@endif
                                @if($pub->link_en_url || $pub->link_ar_url || $pub->link_fr_url)
                                    <div class="resource-card__langs">
                                        @if($pub->link_en_url)<a href="{{ $pub->link_en_url }}" target="_blank" class="resource-card__lang-link">EN</a>@endif
                                        @if($pub->link_ar_url)<a href="{{ $pub->link_ar_url }}" target="_blank" class="resource-card__lang-link">AR</a>@endif
                                        @if($pub->link_fr_url)<a href="{{ $pub->link_fr_url }}" target="_blank" class="resource-card__lang-link">FR</a>@endif
                                    </div>
                                @endif
                                @if($pub->content)
                                    <details class="resource-card__expand">
                                        <summary>Read more</summary>
                                        <div class="resource-card__content">{!! $pub->content !!}</div>
                                    </details>
                                @endif
                            </div>
                        @endif
                    @endforeach
                @else
                    {{-- Hardcoded fallback (shown until seeder is run) --}}
                    <a href="#" class="resource-card resource-card--report">
                        <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                        <div class="resource-card__title">Cloudwork: Social Protection and Inclusion in the Digital Economy in Egypt</div>
                        <div class="resource-card__tag">Egypt</div>
                    </a>
                    <a href="{{ asset('docs/egypt/egypt-delivery-workers-policy-paper.pdf') }}" target="_blank" class="resource-card resource-card--report">
                        <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                        <div class="resource-card__title">Platform work, social protection and representation: a case of delivery workers in Egypt</div>
                        <div class="resource-card__tag">Egypt</div>
                        <span class="resource-card__external">@include('frontend.partials._icon-external')</span>
                    </a>
                    <a href="#" class="resource-card resource-card--report">
                        <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                        <div class="resource-card__title">Social Security Provisions for Workers in the Gig Economy: A Focus on Egypt</div>
                        <div class="resource-card__tag">Egypt</div>
                    </a>
                    <a href="#" class="resource-card resource-card--report">
                        <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                        <div class="resource-card__title">Reaction Note on the Draft Labor Law Regarding the New Forms of Labor</div>
                        <div class="resource-card__tag">Egypt</div>
                    </a>
                    <div class="resource-card resource-card--report">
                        <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                        <div class="resource-card__title">@if(LaravelLocalization::getCurrentLocale()==='ar') العمل الجديد - عمال المنصات الرقمية - حالة الأردن @else New Work, Data and Inclusion in the Digital Economy: Case Study Jordan @endif</div>
                        <div class="resource-card__tag">Jordan</div>
                        <div class="resource-card__langs">
                            <a href="{{ asset('docs/jordan/jordan-platform-workers-policy-paper-en.pdf') }}" target="_blank" class="resource-card__lang-link">EN</a>
                            <a href="{{ asset('docs/jordan/jordan-platform-workers-policy-paper-ar.pdf') }}" target="_blank" class="resource-card__lang-link">AR</a>
                        </div>
                    </div>
                    <a href="#" class="resource-card resource-card--report">
                        <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                        <div class="resource-card__title">The perils of digital work in Lebanon: lessons from taxi and delivery workers</div>
                        <div class="resource-card__tag">Lebanon</div>
                    </a>
                    <div class="resource-card resource-card--report">
                        <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                        <div class="resource-card__title">@if(LaravelLocalization::getCurrentLocale()==='ar') العمل الجديد - عمال المنصات الرقمية - حالة لبنان @else New Work: Platform Workers - Case of Lebanon @endif</div>
                        <div class="resource-card__tag">Lebanon</div>
                        <div class="resource-card__langs">
                            <a href="{{ asset('docs/lebanon/lebanon-platform-workers-report-en.pdf') }}" target="_blank" class="resource-card__lang-link">EN</a>
                            <a href="{{ asset('docs/lebanon/lebanon-platform-workers-report-ar.pdf') }}" target="_blank" class="resource-card__lang-link">AR</a>
                        </div>
                    </div>
                    <div class="resource-card resource-card--report">
                        <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                        <div class="resource-card__title">@if(LaravelLocalization::getCurrentLocale()==='ar') عمال المنصات الرقمية: دراسة حالة المغرب @else Platform Workers: a Morocco Case Study @endif</div>
                        <div class="resource-card__tag">Morocco</div>
                        <div class="resource-card__langs">
                            <a href="{{ asset('docs/morocco/morocco-platform-workers-policy-paper-en.pdf') }}" target="_blank" class="resource-card__lang-link">EN</a>
                            <a href="{{ asset('docs/morocco/morocco-platform-workers-policy-paper-ar.pdf') }}" target="_blank" class="resource-card__lang-link">AR</a>
                            <a href="{{ asset('docs/morocco/morocco-platform-workers-policy-paper-fr.pdf') }}" target="_blank" class="resource-card__lang-link">FR</a>
                        </div>
                    </div>
                    <div class="resource-card resource-card--report">
                        <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                        <div class="resource-card__title">@if(LaravelLocalization::getCurrentLocale()==='ar') أشكال جديدة من العمل، أشكال قديمة من الاستغلال: تحليل اقتصاد المنصات في تونس @else New Forms of Work, Old Forms of Exploitation: Tunisia's Platform and Informal Economies @endif</div>
                        <div class="resource-card__tag">Tunisia</div>
                        <div class="resource-card__langs">
                            <a href="{{ asset('docs/tunisia/tunisia-platform-workers-policy-paper-en.pdf') }}" target="_blank" class="resource-card__lang-link">EN</a>
                            <a href="{{ asset('docs/tunisia/tunisia-platform-workers-policy-paper-ar.pdf') }}" target="_blank" class="resource-card__lang-link">AR</a>
                            <a href="{{ asset('docs/tunisia/tunisia-platform-workers-policy-paper-fr.pdf') }}" target="_blank" class="resource-card__lang-link">FR</a>
                        </div>
                    </div>
                    <a href="#" class="resource-card resource-card--report">
                        <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                        <div class="resource-card__title">Fairwork Egypt 2021: Towards Decent Work in a Highly Informal Economy</div>
                        <div class="resource-card__tag">Egypt</div>
                    </a>
                    <a href="#" class="resource-card resource-card--report">
                        <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                        <div class="resource-card__title">Domestic Platform Work in the Middle East and North Africa</div>
                        <div class="resource-card__tag">MENA</div>
                    </a>
                    <a href="#" class="resource-card resource-card--report">
                        <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                        <div class="resource-card__title">Fairwork Egypt 2022: Platform Workers Amidst Egypt's Economic Crisis</div>
                        <div class="resource-card__tag">Egypt</div>
                    </a>
                    <div class="resource-card resource-card--report">
                        <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                        <div class="resource-card__title">@if(LaravelLocalization::getCurrentLocale()==='ar') العمل الجديد: عمال المنصات الرقمية في مصر 2025 @else New Work: Platform Workers in Egypt 2025 @endif</div>
                        <div class="resource-card__tag">Egypt</div>
                        <div class="resource-card__langs">
                            <a href="{{ asset('docs/egypt/egypt-2025-platform-workers-policy-paper-en.pdf') }}" target="_blank" class="resource-card__lang-link">EN</a>
                            <a href="{{ asset('docs/egypt/egypt-2025-platform-workers-policy-paper-ar.pdf') }}" target="_blank" class="resource-card__lang-link">AR</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Policy Briefs -->
        <div class="resource-section mb-5">
            <h3 class="mb-3" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif
                style="color: #FAAF1C; font-weight: 600; border-left: 4px solid #FAAF1C; padding-left: 1rem;">
                @lang('translation.pw-mena-policy-briefs')
            </h3>
            <div class="resource-cards-grid" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif>
                @if($briefs->isNotEmpty())
                    {{-- Dynamic policy briefs from DB --}}
                    @foreach($briefs as $pub)
                        @php
                            $isAr      = LaravelLocalization::getCurrentLocale() === 'ar';
                            $pubTitle  = ($isAr && $pub->ar_title) ? $pub->ar_title : $pub->title;
                            $hasLangs  = $pub->link_ar || $pub->link_fr;
                            $singleUrl = !$hasLangs ? ($pub->link_en_url ?? $pub->external_url) : null;
                        @endphp
                        @if($singleUrl)
                            <a href="{{ $singleUrl }}" target="_blank" class="resource-card resource-card--brief">
                                <div class="resource-card__icon">@include('frontend.partials._icon-brief')</div>
                                <div class="resource-card__title">{{ $pubTitle }}</div>
                                @if($pub->description)<p class="resource-card__desc">{{ $pub->description }}</p>@endif
                                @if($pub->tag)<div class="resource-card__tag">{{ $pub->tag }}</div>@endif
                                <span class="resource-card__external">@include('frontend.partials._icon-external')</span>
                            </a>
                        @else
                            <div class="resource-card resource-card--brief">
                                <div class="resource-card__icon">@include('frontend.partials._icon-brief')</div>
                                <div class="resource-card__title">{{ $pubTitle }}</div>
                                @if($pub->description)<p class="resource-card__desc">{{ $pub->description }}</p>@endif
                                @if($pub->tag)<div class="resource-card__tag">{{ $pub->tag }}</div>@endif
                                @if($pub->link_en_url || $pub->link_ar_url || $pub->link_fr_url)
                                    <div class="resource-card__langs">
                                        @if($pub->link_en_url)<a href="{{ $pub->link_en_url }}" target="_blank" class="resource-card__lang-link">EN</a>@endif
                                        @if($pub->link_ar_url)<a href="{{ $pub->link_ar_url }}" target="_blank" class="resource-card__lang-link">AR</a>@endif
                                        @if($pub->link_fr_url)<a href="{{ $pub->link_fr_url }}" target="_blank" class="resource-card__lang-link">FR</a>@endif
                                    </div>
                                @endif
                                @if($pub->content)
                                    <details class="resource-card__expand">
                                        <summary>Read more</summary>
                                        <div class="resource-card__content">{!! $pub->content !!}</div>
                                    </details>
                                @endif
                            </div>
                        @endif
                    @endforeach
                @else
                    {{-- Hardcoded fallback (shown until seeder is run) --}}
                    <a href="{{ asset('docs/egypt/egypt-delivery-workers-policy-brief.pdf') }}" target="_blank" class="resource-card resource-card--brief">
                        <div class="resource-card__icon">@include('frontend.partials._icon-brief')</div>
                        <div class="resource-card__title">Social protection and representation for delivery workers in Egypt</div>
                        <div class="resource-card__tag">Egypt</div>
                        <span class="resource-card__external">@include('frontend.partials._icon-external')</span>
                    </a>
                    <a href="#" class="resource-card resource-card--brief">
                        <div class="resource-card__icon">@include('frontend.partials._icon-brief')</div>
                        <div class="resource-card__title">Social Security Provisions for Workers in the Platform Economy: Policy Options with Focus on Egypt</div>
                        <div class="resource-card__tag">Egypt</div>
                    </a>
                    <div class="resource-card resource-card--brief">
                        <div class="resource-card__icon">@include('frontend.partials._icon-brief')</div>
                        <div class="resource-card__title">@if(LaravelLocalization::getCurrentLocale()==='ar') التنقل في الحدود الرقمية: إصلاحات السياسات لعمال المنصات في الأردن @else Navigating the Digital Frontier: Policy Reforms for Platform Workers in Jordan @endif</div>
                        <div class="resource-card__tag">Jordan</div>
                        <div class="resource-card__langs">
                            <a href="{{ asset('docs/jordan/jordan-platform-workers-policy-brief-en.pdf') }}" target="_blank" class="resource-card__lang-link">EN</a>
                            <a href="{{ asset('docs/jordan/jordan-platform-workers-policy-brief-ar.pdf') }}" target="_blank" class="resource-card__lang-link">AR</a>
                        </div>
                    </div>
                    <a href="#" class="resource-card resource-card--brief">
                        <div class="resource-card__icon">@include('frontend.partials._icon-brief')</div>
                        <div class="resource-card__title">Precarious freelancing: Lebanon's grim future of work</div>
                        <div class="resource-card__tag">Lebanon</div>
                    </a>
                    <div class="resource-card resource-card--brief">
                        <div class="resource-card__icon">@include('frontend.partials._icon-brief')</div>
                        <div class="resource-card__title">@if(LaravelLocalization::getCurrentLocale()==='ar') موجز سياسات - عمال المنصات الرقمية - حالة لبنان @else Policy Brief: Platform Workers - Case of Lebanon @endif</div>
                        <div class="resource-card__tag">Lebanon</div>
                        <div class="resource-card__langs">
                            <a href="{{ asset('docs/lebanon/lebanon-platform-workers-policy-brief-en.pdf') }}" target="_blank" class="resource-card__lang-link">EN</a>
                            <a href="{{ asset('docs/lebanon/lebanon-platform-workers-policy-brief-ar.pdf') }}" target="_blank" class="resource-card__lang-link">AR</a>
                        </div>
                    </div>
                    <a href="#" class="resource-card resource-card--brief">
                        <div class="resource-card__icon">@include('frontend.partials._icon-brief')</div>
                        <div class="resource-card__title">Improving Inclusivity in the Platform Economy</div>
                        <div class="resource-card__tag">MENA</div>
                    </a>
                    <div class="resource-card resource-card--brief">
                        <div class="resource-card__icon">@include('frontend.partials._icon-brief')</div>
                        <div class="resource-card__title">Platform Workers in Morocco: a Policy Brief</div>
                        <div class="resource-card__tag">Morocco</div>
                        <div class="resource-card__langs">
                            <a href="{{ asset('docs/morocco/morocco-platform-workers-policy-brief-en.pdf') }}" target="_blank" class="resource-card__lang-link">EN</a>
                            <a href="{{ asset('docs/morocco/morocco-platform-workers-policy-brief-fr.pdf') }}" target="_blank" class="resource-card__lang-link">FR</a>
                        </div>
                    </div>
                    <div class="resource-card resource-card--brief">
                        <div class="resource-card__icon">@include('frontend.partials._icon-brief')</div>
                        <div class="resource-card__title">@if(LaravelLocalization::getCurrentLocale()==='ar') موجز سياسات - عمال المنصات الرقمية - حالة مصر @else Policy Brief: Platform Workers - Case of Egypt @endif</div>
                        <div class="resource-card__tag">Egypt</div>
                        <div class="resource-card__langs">
                            <a href="{{ asset('docs/egypt/egypt-platform-workers-policy-brief-en.pdf') }}" target="_blank" class="resource-card__lang-link">EN</a>
                            <a href="{{ asset('docs/egypt/egypt-platform-workers-policy-brief-ar.pdf') }}" target="_blank" class="resource-card__lang-link">AR</a>
                        </div>
                    </div>
                    <div class="resource-card resource-card--brief">
                        <div class="resource-card__icon">@include('frontend.partials._icon-brief')</div>
                        <div class="resource-card__title">@if(LaravelLocalization::getCurrentLocale()==='ar') موجز سياسات - عمال المنصات الرقمية - حالة تونس @else Policy Brief: Platform Workers - Case of Tunisia @endif</div>
                        <div class="resource-card__tag">Tunisia</div>
                        <div class="resource-card__langs">
                            <a href="{{ asset('docs/tunisia/tunisia-platform-workers-policy-brief-en.pdf') }}" target="_blank" class="resource-card__lang-link">EN</a>
                            <a href="{{ asset('docs/tunisia/tunisia-platform-workers-policy-brief-ar.pdf') }}" target="_blank" class="resource-card__lang-link">AR</a>
                            <a href="{{ asset('docs/tunisia/tunisia-platform-workers-policy-brief-fr.pdf') }}" target="_blank" class="resource-card__lang-link">FR</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Blogposts -->
        <div class="resource-section mb-5">
            <h3 class="mb-3" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif
                style="color: #FAAF1C; font-weight: 600; border-left: 4px solid #FAAF1C; padding-left: 1rem;">
                @lang('translation.pw-mena-blogposts')
            </h3>
            <div class="resource-cards-grid" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif>
                @if($blogs->isNotEmpty())
                    {{-- Dynamic blog posts from DB --}}
                    @foreach($blogs as $pub)
                        @php
                            $isAr     = LaravelLocalization::getCurrentLocale() === 'ar';
                            $pubTitle = ($isAr && $pub->ar_title) ? $pub->ar_title : $pub->title;
                            $blogUrl  = $pub->external_url ?? $pub->link_en_url;
                        @endphp
                        @if($blogUrl)
                            <a href="{{ $blogUrl }}" target="_blank" class="resource-card resource-card--blog">
                                <div class="resource-card__icon">@include('frontend.partials._icon-blog')</div>
                                <div class="resource-card__title">{{ $pubTitle }}</div>
                                @if($pub->description)<p class="resource-card__desc">{{ $pub->description }}</p>@endif
                                <span class="resource-card__external">@include('frontend.partials._icon-external')</span>
                            </a>
                        @else
                            <div class="resource-card resource-card--blog">
                                <div class="resource-card__icon">@include('frontend.partials._icon-blog')</div>
                                <div class="resource-card__title">{{ $pubTitle }}</div>
                                @if($pub->description)<p class="resource-card__desc">{{ $pub->description }}</p>@endif
                                @if($pub->content)
                                    <details class="resource-card__expand">
                                        <summary>Read more</summary>
                                        <div class="resource-card__content">{!! $pub->content !!}</div>
                                    </details>
                                @endif
                            </div>
                        @endif
                    @endforeach
                @else
                    {{-- Hardcoded fallback (shown until seeder is run) --}}
                    <a href="#" class="resource-card resource-card--blog">
                        <div class="resource-card__icon">@include('frontend.partials._icon-blog')</div>
                        <div class="resource-card__title">Digital Platforms: New Professions in Need of Regulation</div>
                    </a>
                    <a href="https://menaobservatory.ai/en/blogs/64" target="_blank" class="resource-card resource-card--blog">
                        <div class="resource-card__icon">@include('frontend.partials._icon-blog')</div>
                        <div class="resource-card__title">New Work: Three Challenges to Protecting Millions of Young Egyptians</div>
                        <span class="resource-card__external">@include('frontend.partials._icon-external')</span>
                    </a>
                    <a href="#" class="resource-card resource-card--blog">
                        <div class="resource-card__icon">@include('frontend.partials._icon-blog')</div>
                        <div class="resource-card__title">Social Security Provisions for Workers in the Platform Economy: Policy Options with Focus on Egypt</div>
                    </a>
                    <a href="#" class="resource-card resource-card--blog">
                        <div class="resource-card__icon">@include('frontend.partials._icon-blog')</div>
                        <div class="resource-card__title">Why So Many Platform Economy Jobs are Informal</div>
                    </a>
                    <a href="#" class="resource-card resource-card--blog">
                        <div class="resource-card__icon">@include('frontend.partials._icon-blog')</div>
                        <div class="resource-card__title">The Flexibility and Desperation of Platform Work in Tunisia</div>
                    </a>
                @endif
            </div>
        </div>

        <!-- b. Webinars and Talks -->
        <div class="pw-subsec mb-5">
            <h3 class="pw-subsec__heading" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif>
                <span class="pw-subsec__letter">b</span> Webinars and Talks
            </h3>
            @if($pubWebinars->isEmpty() && $repoWebinars->isEmpty())
                <div class="pw-empty">No webinars or talks have been added yet.</div>
            @else
                <div class="resource-cards-grid" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif>
                    @foreach($pubWebinars as $pub)
                        @php
                            $isAr     = LaravelLocalization::getCurrentLocale() === 'ar';
                            $pubTitle = ($isAr && $pub->ar_title) ? $pub->ar_title : $pub->title;
                            $pubUrl   = $pub->external_url ?? $pub->link_en_url;
                        @endphp
                        @if($pubUrl)
                            <a href="{{ $pubUrl }}" target="_blank" class="resource-card resource-card--webinar">
                        @else
                            <div class="resource-card resource-card--webinar">
                        @endif
                            <div class="resource-card__icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
                            </div>
                            <div class="resource-card__title">{{ $pubTitle }}</div>
                            @if($pub->description)<p class="resource-card__desc">{{ $pub->description }}</p>@endif
                            @if($pub->tag)<div class="resource-card__tag">{{ $pub->tag }}</div>@endif
                            @if($pubUrl)<span class="resource-card__external">@include('frontend.partials._icon-external')</span>@endif
                        @if($pubUrl)</a>@else</div>@endif
                    @endforeach
                    @foreach($repoWebinars as $r)
                        <a href="{{ route('repo.single', $r->id) }}" class="resource-card resource-card--webinar">
                            <div class="resource-card__icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
                            </div>
                            <div class="resource-card__title">{{ $r->title }}</div>
                            @if($r->description)<p class="resource-card__desc">{{ Str::limit($r->description, 120) }}</p>@endif
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- c. Educational Resources -->
        <div class="pw-subsec mb-5">
            <h3 class="pw-subsec__heading" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif>
                <span class="pw-subsec__letter">c</span> Educational Resources
            </h3>
            @if($pubEdu->isEmpty() && $repoEdu->isEmpty())
                <div class="pw-empty">No educational resources have been added yet.</div>
            @else
                <div class="resource-cards-grid" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif>
                    @foreach($pubEdu as $pub)
                        @php
                            $isAr     = LaravelLocalization::getCurrentLocale() === 'ar';
                            $pubTitle = ($isAr && $pub->ar_title) ? $pub->ar_title : $pub->title;
                            $pubUrl   = $pub->external_url ?? $pub->link_en_url;
                        @endphp
                        @if($pubUrl)
                            <a href="{{ $pubUrl }}" target="_blank" class="resource-card resource-card--edu">
                        @else
                            <div class="resource-card resource-card--edu">
                        @endif
                            <div class="resource-card__icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                            </div>
                            <div class="resource-card__title">{{ $pubTitle }}</div>
                            @if($pub->description)<p class="resource-card__desc">{{ $pub->description }}</p>@endif
                            @if($pub->tag)<div class="resource-card__tag">{{ $pub->tag }}</div>@endif
                            @if($pubUrl)<span class="resource-card__external">@include('frontend.partials._icon-external')</span>@endif
                        @if($pubUrl)</a>@else</div>@endif
                    @endforeach
                    @foreach($repoEdu as $r)
                        <a href="{{ route('repo.single', $r->id) }}" class="resource-card resource-card--edu">
                            <div class="resource-card__icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                            </div>
                            <div class="resource-card__title">{{ $r->title }}</div>
                            @if($r->description)<p class="resource-card__desc">{{ Str::limit($r->description, 120) }}</p>@endif
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

    </div>{{-- end Observatory Outputs --}}

    <!-- Separation Line -->
    <hr style="border: none; border-top: 2px solid #e5e7eb; margin: 3rem 0; width: 100%; opacity: 1;">

    <!-- Section 3: Regional Resources -->
    <div class="mb-5">
        <h2 class="mb-1" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif
            style="color: #006644; font-weight: 700;">
            Regional Resources
        </h2>
        <p class="mb-4" style="color:#6b7280; font-size:.9rem;">External research and resources from the MENA region related to Future of Work.</p>
        @if($regionalRepos->isEmpty())
            <div class="pw-empty">No regional resources have been tagged yet.</div>
        @else
            <div class="resource-cards-grid" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif>
                @foreach($regionalRepos as $r)
                    <a href="{{ route('repo.single', $r->id) }}" class="resource-card resource-card--regional">
                        <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                        <div class="resource-card__title">{{ $r->title }}</div>
                        @if($r->description)<p class="resource-card__desc">{{ Str::limit($r->description, 120) }}</p>@endif
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Separation Line -->
    <hr style="border: none; border-top: 2px solid #e5e7eb; margin: 3rem 0; width: 100%; opacity: 1;">

    <!-- Section 4: Global Resources -->
    <div class="mb-5">
        <h2 class="mb-1" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif
            style="color: #c8870a; font-weight: 700;">
            Global Resources
        </h2>
        <p class="mb-4" style="color:#6b7280; font-size:.9rem;">International research and resources on Future of Work and platform economies.</p>
        @if($globalRepos->isEmpty())
            <div class="pw-empty">No global resources have been tagged yet.</div>
        @else
            <div class="resource-cards-grid" @if(LaravelLocalization::getCurrentLocale()==='ar') dir="rtl" @endif>
                @foreach($globalRepos as $r)
                    <a href="{{ route('repo.single', $r->id) }}" class="resource-card resource-card--global">
                        <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                        <div class="resource-card__title">{{ $r->title }}</div>
                        @if($r->description)<p class="resource-card__desc">{{ Str::limit($r->description, 120) }}</p>@endif
                    </a>
                @endforeach
            </div>
        @endif
    </div>

</div>

<style>
    /* Resource Cards Grid */
    .resource-cards-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
    }

    .resource-card {
        display: flex;
        flex-direction: column;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.5rem;
        text-decoration: none;
        color: #022248;
        position: relative;
        transition: all 0.3s ease;
        min-height: 140px;
        cursor: pointer;
    }

    .resource-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
        text-decoration: none;
        color: #022248;
    }

    .resource-card--report   { border-top: 3px solid #FAAF1C; }
    .resource-card--brief    { border-top: 3px solid #022248; }
    .resource-card--blog     { border-top: 3px solid #60a5fa; }
    .resource-card--webinar  { border-top: 3px solid #0d9488; }
    .resource-card--edu      { border-top: 3px solid #7c3aed; }
    .resource-card--regional { border-top: 3px solid #006644; }
    .resource-card--global   { border-top: 3px solid #c8870a; }

    .resource-card__icon {
        font-size: 1.5rem;
        margin-bottom: 0.75rem;
    }
    .resource-card--report   .resource-card__icon { color: #FAAF1C; }
    .resource-card--brief    .resource-card__icon { color: #022248; }
    .resource-card--blog     .resource-card__icon { color: #60a5fa; }
    .resource-card--webinar  .resource-card__icon { color: #0d9488; }
    .resource-card--edu      .resource-card__icon { color: #7c3aed; }
    .resource-card--regional .resource-card__icon { color: #006644; }
    .resource-card--global   .resource-card__icon { color: #c8870a; }

    /* Sub-section headings (a/b/c letters) */
    .pw-subsec__heading {
        display: flex;
        align-items: center;
        gap: .6rem;
        font-size: 1.1rem;
        font-weight: 700;
        color: #022248;
        margin-bottom: 1rem;
        padding-bottom: .6rem;
        border-bottom: 2px solid #f0f2f5;
    }

    .pw-subsec__letter {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #fef9ee;
        color: #c8870a;
        font-weight: 800;
        font-size: .85rem;
        flex-shrink: 0;
    }

    .pw-empty {
        padding: 2rem;
        text-align: center;
        color: #9ca3af;
        font-size: .9rem;
        background: #f9fafb;
        border: 1px dashed #e5e7eb;
        border-radius: 10px;
    }

    .resource-card__title {
        font-size: 0.95rem;
        font-weight: 600;
        line-height: 1.5;
        flex: 1;
    }

    .resource-card__tag {
        display: inline-block;
        background: #f3f4f6;
        color: #6b7280;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        margin-top: 0.75rem;
        width: fit-content;
    }

    .resource-card__external {
        position: absolute;
        top: 1rem;
        right: 1rem;
        color: #d1d5db;
        font-size: 0.75rem;
        transition: color 0.2s;
    }
    .resource-card:hover .resource-card__external { color: #FAAF1C; }

    .resource-card__langs {
        margin-top: 0.5rem;
    }

    .resource-card__lang-link {
        display: inline-block;
        background: #e0e7ff;
        color: #4338ca;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.15rem 0.5rem;
        border-radius: 4px;
        text-decoration: none;
        transition: background 0.2s;
    }
    .resource-card__lang-link:hover { background: #c7d2fe; text-decoration: none; color: #4338ca; }

    .resource-card__desc {
        font-size: 0.82rem;
        color: #555;
        line-height: 1.55;
        margin: 0.5rem 0 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .resource-card__expand {
        margin-top: 0.75rem;
    }
    .resource-card__expand summary {
        font-size: 0.78rem;
        font-weight: 600;
        color: #FAAF1C;
        cursor: pointer;
        list-style: none;
        user-select: none;
    }
    .resource-card__expand summary::-webkit-details-marker { display: none; }
    .resource-card__expand summary::before { content: '+ '; }
    .resource-card__expand[open] summary::before { content: '− '; }
    .resource-card__content {
        margin-top: 0.6rem;
        font-size: 0.85rem;
        color: #444;
        line-height: 1.65;
        border-top: 1px solid #f0f0f0;
        padding-top: 0.6rem;
    }
    .resource-card__content p { margin-bottom: 0.5rem; }
    .resource-card__content p:last-child { margin-bottom: 0; }

    .institution-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .institution-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 992px) {
        .resource-cards-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .resource-cards-grid {
            grid-template-columns: 1fr;
        }

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
