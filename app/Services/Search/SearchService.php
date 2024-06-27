<?php

namespace App\Services\Search;

use App\Repositories\Search\SearchRepository;

class SearchService
{
    protected $searchRepository;

    public function __construct(SearchRepository $searchRepository)
    {
        $this->searchRepository = $searchRepository;
    }

    public function search($filters)
    {
        return $this->searchRepository->search($filters);
    }
}
