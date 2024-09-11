<?php

namespace App\Repositories\Api\V1;

use App\Models\Question;
use App\Models\Response;
use App\Models\Survey;
use App\Repositories\Contracts\ModelRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class SurveyRepository extends BaseRepository implements ModelRepository
{
    protected $loadable = [Question::class, Response::class];

    protected $table = 'surveys';

    protected $modelClass = Survey::class;

    public function all()
    {
        $surveyData = DB::select("select * from $this->table");

        return Survey::hydrate($surveyData);
    }

    public function find(string $id)
    {
        $surveyData = DB::select(
            "select * from $this->table where id = :id",
            ['id' => $id]
        );

        return Survey::hydrate($surveyData)->first();
    }

    public function create(array $data)
    {
        $created = DB::insert(
            "insert into $this->table (title) values (:title)",
            ['title' => $data['title']]
        );

        if ($created) {
            return $this->findBy(['title' => $data['title']], 'id desc');
        } else {
            throw new Exception('Error creating Survey.');
        }
    }

    public function update(string $id, array $data)
    {
        DB::update(
            "update $this->table set title = :title where id = :id",
            ['title' => $data['title'], 'id' => $id]
        );
    }
}
