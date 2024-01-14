<?php

namespace App\Repositories;

use App\Interfaces\IBaseRepository;
use App\Constants\PaginatorPerPage;
use App\Models\BaseModel;
use App\Traits\ServiceHelper;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\{Builder, Collection, Model};
use Throwable;

abstract class BaseRepository implements IBaseRepository
{
    use ServiceHelper;
    protected Model $modelClass;

    /**
     * @param Model $modelClass
     */
    public function __construct(Model $modelClass)
    {
        $this->modelClass = $modelClass;
    }

    /**
     * @param array $data
     * @param array|string|null $with
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function paginatedList(array $data, mixed $with = null): LengthAwarePaginator
    {
        $query = $this->query();
        if (method_exists($this->getModel(), 'scopeFilter'))
        {
            $query->filter($data);
        }

        if (!is_null($with))
        {
            $query->with($with);
        }

        return $query->paginate(PaginatorPerPage::PER_PAGE);
    }

    /**
     * @param array $data
     * @return BaseModel|BaseModel[]|Builder|Builder[]|Collection|Model|null
     * @throws Throwable
     */

    public function create(array $data): Model|array|Collection|Builder|BaseModel|null
    {
        $model = $this->getModel();
        $model->fill($data);
        $model->save();
        return $model;
    }

    /**
     * @param array $data
     * @param int $id
     * @return BaseModel|BaseModel[]|Builder|Builder[]|Collection|Model|null
     * @throws Throwable
     */
    public function update(array $data, int $id): Model|array|Collection|Builder|BaseModel|null
    {
        $model = $this->findById($id);
        $model->fill($data);
        $model->save();
        return $model;
    }

    /**
     * @param int $id
     * @return array|Builder|Collection|BaseModel
     * @throws Throwable
     */
    public function delete(int $id): array|Builder|Collection|BaseModel
    {
        $model = $this->findById($id);
        $model->delete();
        return $model;
    }

    /**
     * @param int $id
     * @return Model|array|Collection|Builder|BaseModel|null
     * @throws Throwable
     */
    public function findById(int $id): Model|array|Collection|Builder|BaseModel|null
    {
        return $this->getModel()::query()->findOrFail($id);
    }
}
