<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stage extends Model
{
    protected $fillable = [
        'title',
        'sort',
        'stage_id',
        'user_id',
        'project_id',
        'start_date',
        'finish_date',
        'comments',
        'status',
        'status_1',
        'status_2',
        'status_3',
    ];

    public static  $statuses = [
        'status_0' => '---',
        'status_1' => 'Планируется',
        'status_2' => 'В работе',
        'status_3' => 'Завершен',
    ];


    public function child_stages()
    {
        return $this->hasMany(Stage::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(StageFile::class);
    }

    public static function calcProgress (int $projectId) {
        $stagesCount = self::where('project_id', $projectId)->count();
        $stagesCountCompleted = self::where(['project_id' => $projectId, 'status' => 'status_3'])->count();
        $progress = ($stagesCountCompleted / $stagesCount) * 100;
        return $progress;
    }


    public static function makeStagesFromSample(Project $project)
    {

        $stages = SampleStage::whereNull('sample_stage_id')
            ->with('sample_stages')
            ->get();


        foreach ($stages as $stage) {

            $data = [
                'title' => $stage->title,
                'sort' => $stage->sort,
                'stage_id' => null,
                'user_id' => auth()->user()->id,
                'project_id' => $project->id,
                'status' => 'status_1',
            ];

            $item = Stage::create($data);



            foreach ($stage->sample_stages as $child_stage) {

                $data = [
                    'title' => $child_stage->title,
                    'sort' => $child_stage->sort,
                    'stage_id' => $item->id,
                    'user_id' => auth()->user()->id,
                    'project_id' => $project->id,
                    'status' => 'status_1',
                ];

                Stage::create($data);


            }

        }
    }


    protected $casts = [
        'start_date' => 'datetime',
        'finish_date' => 'datetime',
        'status_0' => 'datetime',
        'status_1' => 'datetime',
        'status_2' => 'datetime',
        'status_3' => 'datetime',

    ];

}
