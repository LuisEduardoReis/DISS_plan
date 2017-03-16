<?php

namespace DISS_plan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DISS_plan\Topic;
use DISS_plan\Activity;
use DISS_plan\TopicActivity;
use DISS_plan\Save;



class SaveController extends Controller
{

    public function create(Request $request) {
        $data = [];
        $data['topics'] = Topic::all();
        $data['activities'] = Activity::all();
        $data['topic_activity'] = TopicActivity::all();

        $save = new Save;
        $save->name = $request->name == NULL ? ' ' : $request->name;
        $save->data = json_encode($data);
        $save->save();

        return redirect('saves');
    }

    public function restore(Request $request) {
        $save = Save::findOrFail($request->save_id);
        $data = json_decode($save->data);

        $tables = [
            'topics' => Topic::class,
            'activities' => Activity::class,
            'topic_activity' => TopicActivity::class
        ];

        foreach($tables as $key => $value) {
            DB::statement("TRUNCATE $key CASCADE");
        }
        foreach($tables as $tkey => $tvalue) {

            foreach($data->$tkey as $element_data) {
                $element = new $tvalue;
                foreach($element_data as $key => $value) {
                    $element[$key] = $value;
                }
                $element->save();
            }
        }
        return redirect('saves');
    }
}
