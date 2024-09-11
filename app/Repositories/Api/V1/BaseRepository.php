<?php

namespace App\Repositories\Api\V1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

abstract class BaseRepository
{
    protected $loadable = [];

    protected $table = '';

    protected $modelClass = '';

    public function findBy(array $params, $orderBy)
    {
        $query = "select * from $this->table where ";

        // collect($params)->map(function ($value, $field) use ($query) {
        //     $query .= "$field = :$field ";
        // });
        foreach (array_keys($params) as $idx => $field) {
            $query .= $idx ? 'and ' : '';
            $query .= "$field = :$field ";
        }

        if ($orderBy) {
            $query .= " order by $orderBy";
        }

        $modelData = DB::select($query, $params);

        return app($this->modelClass)::hydrate($modelData)->first();
    }

    public function withRelationship(Model $model, string $relationshipModel, ?string $order = null)
    {
        if (empty($model) || ! in_array($relationshipModel, $this->loadable)) {
            return null;
        }

        $relationshipTable = app($relationshipModel)->getTable();

        $modelId = Str::lower(class_basename($model)).'_id';

        $selectQuery = "select * from $relationshipTable where $modelId = :$modelId";

        if ($order) {
            $selectQuery .= " order by $order";
        }

        $relationshipData = DB::select(
            $selectQuery,
            [$modelId => $model->id]
        );

        $relationship = Str::plural(Str::lower(class_basename($relationshipModel)));

        $model->$relationship = app($relationshipModel)::hydrate($relationshipData);

        return $model;
    }
}
