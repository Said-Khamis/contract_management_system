<?php

namespace App\Helpers;

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginationHelper extends LengthAwarePaginator
{

    /**
     * @param Collection $collection
     * @param int $itemsPerPage
     * @return LengthAwarePaginator
     * @throws BindingResolutionException
     */
    public static function paginate(Collection $collection, int $itemsPerPage): LengthAwarePaginator
    {
        $pageNumber = self::resolveCurrentPage();

        $totalPageNumber = $collection->count();

        return self::paginator(
            $collection->forPage($pageNumber, $itemsPerPage),
            $totalPageNumber,
            $itemsPerPage,
            $pageNumber,
            [
                'path' => self::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );
    }

    /**
     * Create a new Length aware paginator instance.
     *
     * @param Collection $items
     * @param int $total
     * @param int $perPage
     * @param int $currentPage
     * @param array $options
     * @return LengthAwarePaginator
     * @throws BindingResolutionException
     */
    protected static function paginator(Collection $items, int $total, int $perPage, int $currentPage, array $options): LengthAwarePaginator
    {
        return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
            'items', 'total', 'perPage', 'currentPage', 'options'
        ));
    }
}
