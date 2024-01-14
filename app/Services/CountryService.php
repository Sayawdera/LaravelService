<?php

namespace App\Services;

use App\Repositories\CountryRepository;

class CountryService extends BaseService
{
    /**
     * @param CountryRepository $repository
     */
    public function __construct(CountryRepository $repository)
    {
        $this->repository = $repository;
    }
}
