<?php

namespace DISS_plan;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    public function topics() {
        return $this->belongsToMany(Topic::class, 'topic_activity', 'activity_id', 'topic_id')->withTimestamps();
    }
}
