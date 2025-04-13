<?php

use App\Http\Controllers\AdditionalResourcesController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RegionalController;
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


Route::group(['prefix' => LaravelLocalization::setLocale(),
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

    Route::get('/news_events', [HomeController::class, 'news_events'])->name('news_events');
    Route::get('/news', [NewsController::class, 'news'])->name('news-all');

    Route::get('/news/html_list', [NewsController::class, 'js_list_view'])->name('news.html_list');
    Route::get('/news/{id}', [NewsController::class, 'single'])->name('news');
    Route::get('/events/{id}', [EventsController::class, 'single'])->name('events.single');

    Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs');
    Route::get('/blogs/html_list', [BlogsController::class, 'js_list_view'])->name('blogs.html_list');
    Route::get('/blogs/{id}', [BlogsController::class, 'single'])->name('blogs.single');

    Route::get('/regional', [RegionalController::class, 'index'])->name('regional');
    Route::get('/regional/html_list', [RegionalController::class, 'js_list_view'])->name('regional.html_list');
    Route::get('/regional/{id}', [RegionalController::class, 'country'])->name('regional.country');
    Route::get('/regional-repository/{id}', [RegionalController::class, 'single'])->name('repo.single');

    Route::get('/additional-resources/{id}', [AdditionalResourcesController::class, 'single'])->name('resources.single');

    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    Route::get('/community/{id}', [CommunityController::class, 'show'])->name('community_single');
    Route::get('/profile', [CommunityController::class, 'profile'])->name('profile');

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
