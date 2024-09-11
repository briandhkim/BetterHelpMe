<?php

namespace App\Repositories\Api\V1;

use App\Models\Answer;
use App\Models\Response;
use App\Repositories\Contracts\ModelRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class ResponseRepository extends BaseRepository implements ModelRepository
{
    protected $loadable = [Answer::class];

    protected $table = 'responses';

    protected $modelClass = Response::class;

    public function all() {}

    public function find(string $id)
    {
        $responseData = DB::select(
            "select * from $this->table where id = :id",
            ['id' => $id]
        );

        return Response::hydrate($responseData)->first();
    }

    public function create(array $data)
    {
        $created = DB::insert(
            "
                insert into $this->table (survey_id)
                values (:survey_id)
            ",
            [
                'survey_id' => $data['survey_id'],
            ]
        );

        if ($created) {
            return $this->findBy($data, 'id desc');
        } else {
            throw new Exception('Error creating Response.');
        }
    }

    public function update(string $id, array $data) {}
}
