<?php

namespace App\Http\Controllers;

use App\Http\Resources\CrudGeneratorResources;
use Illuminate\Http\Request;
use Throwable;
use App\Models\CrudGenerator;
use App\Services\CrudGeneratorService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreCrudGeneratorRequest;
use App\Http\Requests\UpdateRequest\UpdateCrudGeneratorRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CrudGeneratorController extends Controller
{
    /**
     * @var CrudGeneratorService
     */
    private CrudGeneratorService $service;

    /**
     * @param CrudGeneratorService $service
     */
    public function __construct(CrudGeneratorService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws Throwable
     */
    public function index(Request $request)
    {
        return CrudGeneratorResources::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreCrudGeneratorRequest $request
     * @return array|Builder|Collection|CrudGenerator
     * @throws Throwable
     */
    public function store(StoreCrudGeneratorRequest $request): array |Builder|Collection|CrudGenerator
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $crudgeneratorId
     * @return CrudGeneratorResources
     * @throws Throwable
     */
    public function show($crudgeneratorId)
    {
        return new CrudGeneratorResources( $this->service->getModelById( $crudgeneratorId ));
    }

    /**
     * @param UpdateCrudGeneratorRequest $request
     * @param int $crudgeneratorId
     * @return array|CrudGenerator|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateCrudGeneratorRequest $request, int $crudgeneratorId): array |CrudGenerator|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $crudgeneratorId);

    }

    /**
     * @param int $crudgeneratorId
     * @return array|Builder|Collection|CrudGenerator
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|CrudGenerator
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}
