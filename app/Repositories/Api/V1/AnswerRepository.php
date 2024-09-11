<?php

namespace App\Repositories\Api\V1;

use App\Models\Answer;
use App\Repositories\Contracts\ModelRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class AnswerRepository extends BaseRepository implements ModelRepository
{
    protected $loadable = [];

    protected $table = 'answers';

    protected $modelClass = Answer::class;

    public function all() {}

    public function find(string $id) {}

    public function create(array $data)
    {
        $created = DB::insert(
            "
                insert into $this->table (question_id, response_id, input)
                values (:question_id, :response_id, :input)
            ",
            [
                'question_id' => $data['question_id'],
                'response_id' => $data['response_id'],
                'input' => $data['input'],
            ]
        );

        if ($created) {
            return $this->findBy($data, 'id desc');
        } else {
            throw new Exception('Error creating Answer.');
        }
    }

    public function update(string $id, array $data) {}
}
