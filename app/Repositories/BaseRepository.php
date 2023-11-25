<?php

namespace App\Repositories;

use App\Models\Country;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    protected $with = [];

    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     *
     * @throws \Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Get searchable fields array
     *
     * @return array
     */
    abstract public function getFieldsSearchable();

    /**
     * Configure the Model
     *
     * @return string
     */
    abstract public function model();

    /**
     * Make Model instance
     *
     * @throws \Exception
     *
     * @return Model
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Paginate records for scaffold.
     *
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @param string $orderDirection
     * @param string|null $orderBy


     */
    public function paginate($perPage, $orderBy = 'created_at', $orderDirection = 'desc', $columns = ['*'])
    {
        $query = $this->allQuery();

        return $query->orderBy($orderBy, $orderDirection)->paginate($perPage, $columns);
    }

    /**
     * Build a query for retrieving all records.
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @return Builder
     */
    public function allQuery($search = [], $skip = null, $limit = null)
    {
        $query = $this->model->newQuery();

        if (count($search)) {
            foreach($search as $key => $value) {
                if (in_array($key, $this->getFieldsSearchable())) {
                    $query->where($key, $value);
                }
            }
        }

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query;
    }

    /**
     * Retrieve all records with given filter criteria
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        $query = $this->allQuery($search, $skip, $limit);

        return $query->get($columns);
    }

    /**
     * Create new model record
     *
     * @param array $input user inputs
     *
     * @return Model
     */
    public function create(array $input): Model
    {
        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }

    /**
     * Create new model record with related model
     *
     * @param array $input user inputs
     * @param Model $parentModel parent related model
     * @param string $relationship child relationship name from relate model instance
     * @return Model new model instance tobe created
     */
    public function createWithRelation(array $input, Model $parentModel, string $relationship): Model
    {
        $model = $this->model->newInstance($input);

        return $parentModel->{$relationship}()->save($model);
    }

    public function associateAndSave(array $input ,array $parentModels, array $relationships): Model
    {
        $model = $this->model->newInstance($input);
        foreach ($parentModels as $key => $parentModel){
            $model->{$relationships[$key]}()->associate($parentModel);
        }
        $model->save();
        return $model;
    }

    /**
     * save new model record with related model
     *
     * @param Model $newModel
     * @param Model $parentModel parent related model
     * @param string $relationship child relationship name from relate model instance
     * @return Model new model instance tobe created
     */
    public function saveWithRelation(Model $newModel, Model $parentModel, string $relationship): Model
    {
        return $parentModel->{$relationship}()->save($newModel);
    }

    /**
     * instantiate new model instance with or without inputs
     * @param array $input user inputs
     * @return Model
     */
    public function new(array $input = []): Model
    {
        return $this->model->newInstance($input);
    }

    /**
     * Find model record for given id
     *
     * @param int $id
     * @param array $columns
     *
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id, $columns = ['*']){
        $query = $this->model->newQuery();
        return $query->find($id, $columns);
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function update($input, $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $model->fill($input);

        $model->save();

        return $model;
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        return $model->delete();
    }

    /* SET RELATIONS FOR EAGER LOADING
     * */

    public function with($relation){
        if (is_string($relation)){
            $this->with = explode(',', $relation);
            return $this;
        }
        $this->with = is_array($relation)
            ? $relation
            : [];

        return $this;
    }

    protected function query(){
        return $this->model->newQuery()
            ->with($this->with);
    }
}
