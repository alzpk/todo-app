<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'finished_tasks',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function getFinishedTasksAttribute()
    {
        return $this->tasks()->where('is_done', 1)->count();
    }

    public function getProgressAttribute()
    {
        $total = $this->tasks()->count();

        if ($total == 0) {
            return 100;
        }

        $finished = $this->getFinishedTasksAttribute();

        return ceil(($finished / $total) * 100);
    }
}
