<?php

namespace App\Http\Controllers;

use App\Constants\UsersRoles;
use App\Dtos\ApiResponse;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UsersService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreUserRequest;
use App\Http\Requests\UpdateRequest\UpdateUserRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    /**
     * @var UsersService
     */
    private UsersService $service;

    /**
     * @param UsersService $service
     */
    public function __construct(UsersService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        return UserResource::collection( $this->service->paginatedList( $request->all() ));
    }

    /**
     * @param StoreUserRequest $request
     * @return array|Builder|Collection|User
     * @throws \Throwable
     */
    public function store(StoreUserRequest $request): array|Builder|Collection|User
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param int $crudgeneratorId
     * @return UserResource
     * @throws \Throwable
     */
    public function show(int $crudgeneratorId)
    {
        return new UserResource( $this->service->getModelById($crudgeneratorId) );
    }

    /**
     * @param UpdateUserRequest $request
     * @param int $crudgeneratorId
     * @return array|User|Collection|Builder
     * @throws \Throwable
     */
    public function update(UpdateUserRequest $request, int $crudgeneratorId): array|User|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $crudgeneratorId);

    }

    /**
     * @param int $crudgeneratorId
     * @return array|Builder|Collection|User|bool
     * @throws \Throwable
     */
    public function destroy(int $crudgeneratorId): array|Builder|Collection|User|bool
    {
        return $this->service->deleteModel($crudgeneratorId);
    }

    /**
     * @param UsersRoles $role
     * @return JsonResponse
     */
    public function roles(UsersRoles $role): JsonResponse
    {
        return ApiResponse::success($role->getRoleList());
    }
}
