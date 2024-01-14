<?php

namespace App\Traits;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\{Builder, Model};
use Throwable;

trait ServiceHelper
{
    protected function __construct(){}

    /**
     * @return Builder|BaseModel
     * @throws Throwable
     */
    protected function query(): Builder|BaseModel
    {
        $query = $this->getModel()->query();
        return $query->orderByDesc('id');
    }

    /**
     * @return Model
     * @throws Throwable
     */
    protected function getModel(): Model
    {
        return $this->modelClass;
    }
}
