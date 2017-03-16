<?php

use DISS_plan\Topic;
use DISS_plan\Activity;

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

Route::get('/', function() {
    return view('home');
});

Route::get('/topics', function () {
    $topics_game = Topic::where('type','game')->orderBy('type', 'asc')->orderBy('created_at','asc')->get();
    $topics_prog = Topic::where('type','prog')->orderBy('type', 'asc')->orderBy('created_at','asc')->get();

    return view('topics', [
        'topics_game' => $topics_game,
        'topics_prog' => $topics_prog
    ]);
});

Route::get('/activities', function () {
    $activities = Activity::orderBy('created_at', 'asc')->get();
    $topics = Topic::orderBy('type', 'asc')->orderBy('created_at','asc')->get();

    return view('activities', [
        'activities' => $activities,
        'topics' => $topics
    ]);
});
