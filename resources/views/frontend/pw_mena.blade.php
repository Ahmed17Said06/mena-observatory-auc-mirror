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
                                @if($pub->tag)<div class="resource-card__tag">{{ $pub->tag }}</div>@endif
                                <span class="resource-card__external">@include('frontend.partials._icon-external')</span>
                            </a>
                        @else
                            <div class="resource-card resource-card--report">
                                <div class="resource-card__icon">@include('frontend.partials._icon-doc')</div>
                                <div class="resource-card__title">{{ $pubTitle }}</div>
                                @if($pub->tag)<div class="resource-card__tag">{{ $pub->tag }}</div>@endif
                                @if($pub->link_en_url || $pub->link_ar_url || $pub->link_fr_url)
                                    <div class="resource-card__langs">
                                        @if($pub->link_en_url)<a href="{{ $pub->link_en_url }}" target="_blank" class="resource-card__lang-link">EN</a>@endif
                                        @if($pub->link_ar_url)<a href="{{ $pub->link_ar_url }}" target="_blank" class="resource-card__lang-link">AR</a>@endif
                                        @if($pub->link_fr_url)<a href="{{ $pub->link_fr_url }}" target="_blank" class="resource-card__lang-link">FR</a>@endif
                                    </div>
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
                                @if($pub->tag)<div class="resource-card__tag">{{ $pub->tag }}</div>@endif
                                <span class="resource-card__external">@include('frontend.partials._icon-external')</span>
                            </a>
                        @else
                            <div class="resource-card resource-card--brief">
                                <div class="resource-card__icon">@include('frontend.partials._icon-brief')</div>
                                <div class="resource-card__title">{{ $pubTitle }}</div>
                                @if($pub->tag)<div class="resource-card__tag">{{ $pub->tag }}</div>@endif
                                @if($pub->link_en_url || $pub->link_ar_url || $pub->link_fr_url)
                                    <div class="resource-card__langs">
                                        @if($pub->link_en_url)<a href="{{ $pub->link_en_url }}" target="_blank" class="resource-card__lang-link">EN</a>@endif
                                        @if($pub->link_ar_url)<a href="{{ $pub->link_ar_url }}" target="_blank" class="resource-card__lang-link">AR</a>@endif
                                        @if($pub->link_fr_url)<a href="{{ $pub->link_fr_url }}" target="_blank" class="resource-card__lang-link">FR</a>@endif
                                    </div>
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
                                <span class="resource-card__external">@include('frontend.partials._icon-external')</span>
                            </a>
                        @else
                            <div class="resource-card resource-card--blog">
                                <div class="resource-card__icon">@include('frontend.partials._icon-blog')</div>
                                <div class="resource-card__title">{{ $pubTitle }}</div>
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

    .resource-card--report { border-top: 3px solid #FAAF1C; }
    .resource-card--brief  { border-top: 3px solid #022248; }
    .resource-card--blog   { border-top: 3px solid #60a5fa; }

    .resource-card__icon {
        font-size: 1.5rem;
        margin-bottom: 0.75rem;
    }
    .resource-card--report .resource-card__icon { color: #FAAF1C; }
    .resource-card--brief  .resource-card__icon { color: #022248; }
    .resource-card--blog   .resource-card__icon { color: #60a5fa; }

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
