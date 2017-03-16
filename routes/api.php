<?php

namespace DISS_plan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



// *** TOPIC *** //
Route::post('/topic', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'type' => 'required|max:255'
    ]);

    if ($validator->fails()) {
        return redirect('/topics')
            ->withInput()
            ->withErrors($validator);
    }

    foreach (explode("\n",$request->name) as $topic_name) {
        $topic = new Topic;
        $topic->name = trim($topic_name);
        $topic->type = $request->type;
        $topic->save();
    }
    return redirect('/topics');
});
Route::delete('/topic/{id}', function($id) {
    //Topic::findMany(explode(",",$id))->delete();
    DB::table('topics')->whereIn('id', explode(",",$id))->delete();

    return redirect('/topics');
});

// *** ACTIVITY *** //
Route::post('/activity/{topics?}', function (Request $request, $topics = "") {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255'
    ]);

    if ($validator->fails()) {
        return redirect('/activities')
            ->withInput()
            ->withErrors($validator);
    }

    $activity = new Activity;
    $activity->name = $request->name;
    $activity->save();

    foreach (explode(",",$topics) as $topic) {
        $ta = new TopicActivity;
        $ta->topic_id = $topic;
        $ta->activity_id = $activity->id;
        $ta->save();
    }

    return redirect('/activities');
});
Route::delete('/activity/{id}', function($id) {
    Activity::findOrFail($id)->delete();

    return redirect('/activities');
});

// *** TOPIC_ACTIVITY *** //
Route::post('/topic_activity', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'topic_id' => 'required',
        'activity_id' => 'required'
    ]);

    if ($validator->fails()) {
        return redirect('/activities')
            ->withInput()
            ->withErrors($validator);
    }

    $ta = new TopicActivity;
    $ta->topic_id = $request->topic_id;
    $ta->activity_id = $request->activity_id;
    $ta->save();

    return redirect('/activities');
});
Route::delete('/topic_activity/{activity_id}/{topic_id}', function($activity_id, $topic_id) {
    TopicActivity::where(['activity_id'=>$activity_id, 'topic_id'=>$topic_id])->delete();

    return redirect('/activities');
});


// *** SAVES *** //
Route::post('/save_create', 'SaveController@create');
Route::post('/save_restore', 'SaveController@restore');