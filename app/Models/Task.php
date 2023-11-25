<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title
 * @property string $description
 * @property boolean $active
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    /**
     * Return labels of task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function labels(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'tasks_labels',
            'task_id', 'label_id');
    }

}
