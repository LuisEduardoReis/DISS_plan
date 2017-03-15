<?php

namespace DISS_plan;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';

    public function getTypeName() {
        switch($this->type) {
            case 'game': return 'Games';
            case 'prog': return 'Programming';
            default: return 'Null';
        }
    }

    public function activities() {
        return $this->hasMany(Activity::class, 'topic_activity', 'topic_id', 'activity_id');
    }
}
