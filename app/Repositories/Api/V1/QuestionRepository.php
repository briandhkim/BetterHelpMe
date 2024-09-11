<?php

namespace App\Repositories\Api\V1;

use App\Models\Choice;
use App\Models\Question;
use App\Repositories\Contracts\ModelRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class QuestionRepository extends BaseRepository implements ModelRepository
{
    protected $loadable = [Choice::class];

    protected $table = 'questions';

    protected $modelClass = Question::class;

    public function all() {}

    public function find(string $id)
    {
        $questionData = DB::select(
            "select * from $this->table where id = :id",
            ['id' => $id]
        );

        return Question::hydrate($questionData)->first();
    }

    public function create(array $data)
    {
        $created = DB::insert(
            "
                insert into $this->table (title, type, survey_id) 
                values (:title, :type, :survey_id)
            ",
            [
                'title' => $data['title'],
                'type' => $data['type'],
                'survey_id' => $data['survey_id'],
            ]
        );

        if ($created) {
            return $this->findBy($data, 'id desc');
        } else {
            throw new Exception('Error creating Question.');
        }
    }

    public function update(string $id, array $data)
    {
        DB::update(
            "update $this->table set title = :title, type = :type where id = :id and survey_id = :survey_id",
            [
                'id' => $id,
                'survey_id' => $data['survey_id'],
                'title' => $data['title'],
                'type' => $data['type'],
            ]
        );
    }
}
