<?php

namespace App\Traits;

trait FilterPropertiesTrait
{
    public array $searchFilter = [], $joins = [];
    public int $limit = 10, $skip = 0;
    public function setSearchFilter(array $filters): void
    {
        $this->searchFilter = $filters;
    }
    public function getSearchFilter(): array
    {
        return $this->searchFilter;
    }
}
