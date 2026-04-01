<?php

use App\Http\Controllers\AdditionalResourcesController;
use App\Http\Controllers\BrochureController;
use App\Models\Repo;
use App\Models\YoutubeVideo;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RegionalController;
use App\Http\Controllers\NewWorkController;
use App\Http\Controllers\PwMenaController;
use App\Models\static_content;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::get('/', function () {
        return redirect(LaravelLocalization::localizeUrl('/home'));
    });
    Route::get('/verify', function () {
        return view('auth.verify-email');
    });
    Route::get('/reset-password', function () {
        return view('auth.change-password');
    });
    Route::get('/about_us', [HomeController::class, 'about_us'])->name('about_us');
    Route::get('/collaborate', [HomeController::class, 'Collaborate'])->name('collaborate');
    Route::get('/work_together', [FormsController::class, 'workTogetherView'])->name('work_together');
    Route::post('/work_together', [FormsController::class, 'workTogether'])->name('post.work.together');
    Route::get('/submit_your_work', [FormsController::class, 'submitYourWorkView'])->name('submit_your_work');
    Route::post('/submit_your_work', [FormsController::class, 'submitWork'])->name('post.submit.work');
    Route::get('/submit_an_event', [FormsController::class, 'submitEventView'])->name('submit_an_event');
    Route::post('/submit_an_event', [FormsController::class, 'submitEvent'])->name('post.submit.event');
    Route::get('/contact_us', [HomeController::class, 'contact_us'])->name('contact_us');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/coming-soon', [HomeController::class, 'comingSoon'])->name('coming-soon');
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    Route::get('/ai-indices', [HomeController::class, 'aiIndices'])->name('ai_indices');
    Route::post('/subscribe', [HomeController::class, 'subscribe'])->name('subscribe');

    Route::get('/news_events', [HomeController::class, 'news_events'])->name('news_events');
    Route::get('/news', [NewsController::class, 'news'])->name('news.index');
    Route::get('/podcasts', [HomeController::class, 'podcasts'])->name('podcasts');

    Route::get('/news/html_list', [NewsController::class, 'js_list_view'])->name('news.html_list');
    Route::get('/news/rai-cup-2026', function () {
        return view('frontend.rai-cup', [
            'rai_cup_hero_title'     => static_content::where('key', 'rai_cup_hero_title')->first(),
            'rai_cup_hero_subtitle'  => static_content::where('key', 'rai_cup_hero_subtitle')->first(),
            'rai_cup_event_date'     => static_content::where('key', 'rai_cup_event_date')->first(),
            'rai_cup_event_location' => static_content::where('key', 'rai_cup_event_location')->first(),
            'rai_cup_body'           => static_content::where('key', 'rai_cup_body')->first(),
        ]);
    })->name('news.rai-cup');
    Route::get('/news/open-call-ai-solutions', function () {
        return view('frontend.news.open-call-ai-solutions', [
            'ocais_hero_title'    => static_content::where('key', 'ocais_hero_title')->first(),
            'ocais_hero_subtitle' => static_content::where('key', 'ocais_hero_subtitle')->first(),
            'ocais_body'          => static_content::where('key', 'ocais_body')->first(),
        ]);
    })->name('news.open-call-ai-solutions');
    Route::get('/news/open-call-rai-use-cases', function () {
        return view('frontend.news.open-call-rai-use-cases', [
            'ocruc_hero_title'    => static_content::where('key', 'ocruc_hero_title')->first(),
            'ocruc_hero_subtitle' => static_content::where('key', 'ocruc_hero_subtitle')->first(),
            'ocruc_body'          => static_content::where('key', 'ocruc_body')->first(),
        ]);
    })->name('news.open-call-rai-use-cases');
    Route::get('/safe-ai-children', function () {
        return view('frontend.coming-soon'); })->name('safe_ai_children');
    Route::get('/news/{id}', [NewsController::class, 'single'])->name('news');
    Route::get('/events/{id}', [EventsController::class, 'single'])->name('events.single');

    Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs');
    Route::get('/blogs/html_list', [BlogsController::class, 'js_list_view'])->name('blogs.html_list');
    Route::get('/blogs/{id}', [BlogsController::class, 'single'])->name('blogs.single');

    // NEW WORK routes
    Route::get('/new_work', [NewWorkController::class, 'index'])->name('new_work');
    // Replace reports routes with blogs routes
    Route::get('/new_work/blogs', [NewWorkController::class, 'blogs'])->name('new_work.blogs');
    Route::get('/new_work/blogs/html_list', [NewWorkController::class, 'blogsHtmlList'])->name('new_work.blogs.html_list');
    Route::get('/new_work/policy-briefs', [NewWorkController::class, 'policyBriefs'])->name('new_work.policy-briefs');
    Route::get('/new_work/policy-briefs/html_list', [NewWorkController::class, 'policyBriefsHtmlList'])->name('new_work.policy-briefs.html_list');

    // Add the new work blogs single view route
    Route::get('/new_work/blogs/{id}', [NewWorkController::class, 'newWorkBlogSingle'])->name('new-work-blogs.single');

    // Future of Work MENA route
    Route::get('/pw-mena', [PwMenaController::class, 'index'])->name('pw_mena');

    // Feminist AI route
    Route::get('/feminist-ai', function () {
        $keys = [
            'fai_subtitle', 'fai_about', 'fai_partnership',
            'fai_pillar_1_title', 'fai_pillar_1_desc',
            'fai_pillar_2_title', 'fai_pillar_2_desc',
            'fai_pillar_3_title', 'fai_pillar_3_desc',
            'fai_pillar_4_title', 'fai_pillar_4_desc',
            'fai_cta_title', 'fai_cta_text',
        ];
        $fai = static_content::whereIn('key', $keys)->get()->keyBy('key');
        $genderResources = Repo::whereHas('tags', fn($q) => $q->where('name', 'Gender'))
            ->with('tags')
            ->latest('publish_date')
            ->limit(6)
            ->get();
        return view('frontend.feminist_ai', [
            'fai_subtitle'     => $fai->get('fai_subtitle'),
            'fai_about'        => $fai->get('fai_about'),
            'fai_partnership'  => $fai->get('fai_partnership'),
            'fai'              => $fai,
            'genderResources'  => $genderResources,
        ]);
    })->name('feminist_ai');

    Route::get('/regional', [RegionalController::class, 'index'])->name('regional');
    Route::get('/regional/our-work', [RegionalController::class, 'ourWork'])->name('regional.our_work');
    Route::get('/regional/regional-other-work', [RegionalController::class, 'regionalOtherWork'])->name('regional.regional_other_work');
    Route::get('/regional/global-other-work', [RegionalController::class, 'globalOtherWork'])->name('regional.global_other_work');
    // Keep old route as redirect to avoid broken links
    Route::get('/regional/other-work', function() { return redirect()->route('regional.regional_other_work'); })->name('regional.other_work');
    Route::get('/regional/videos', [RegionalController::class, 'videos'])->name('regional.videos');
    Route::get('/regional/html_list', [RegionalController::class, 'js_list_view'])->name('regional.html_list');
    Route::get('/regional/{id}', [RegionalController::class, 'country'])->name('regional.country');
    Route::get('/regional-repository/{id}', [RegionalController::class, 'single'])->name('repo.single');

    Route::get('/additional-resources/{id}', [AdditionalResourcesController::class, 'single'])->name('resources.single');

    Route::get('/brochures', function () {
        $brochures = \App\Models\Brochure::where('is_published', true)->latest()->get();
        return view('frontend.brochures-list', compact('brochures'));
    })->name('brochures.index');

    Route::get('/brochure/{slug}', [BrochureController::class, 'show'])->name('brochure.show');

    Route::get('/publications', function () {
        return view('frontend.publications');
    })->name('publications');

    Route::get('/webinars', function () {
        $videos = YoutubeVideo::published()
            ->whereHas('tags', fn($q) => $q->where('name', 'Webinar'))
            ->orderBy('sort_order')
            ->latest()
            ->get();
        $repoWebinars = Repo::whereHas('tags', fn($q) => $q->where('name', 'Webinar'))
            ->with('tags')
            ->latest('publish_date')
            ->get();
        return view('frontend.webinars', compact('videos', 'repoWebinars'));
    })->name('webinars');

    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    Route::get('/community/{id}', [CommunityController::class, 'show'])->name('community_single');
    Route::get('/profile', [CommunityController::class, 'profile'])->name('profile');
    // Community page
    // Route::get('/communites', function () {
    //     return view('components.frontend.component.communites');
    // })->name('communites');
    Route::get('/communities', [CommunityController::class, 'communities'])->name('communities');

    // Collaborators page
    Route::get('/collaborators', [CommunityController::class, 'collaborators'])->name('collaborators');

    Route::group(['middleware' => 'auth'], function () {
        //    Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
//    Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
//    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
//    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
//    Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
//    Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
//    Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
//    Route::get('/{page}', [PageController::class, 'index'])->name('page');
//	Route::post('logout', [LoginController::class, 'logout'])->name('logout');


    });
});

