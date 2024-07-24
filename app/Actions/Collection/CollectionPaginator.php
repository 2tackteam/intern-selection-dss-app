<?php

namespace App\Actions\Collection;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as SupportCollection;

class CollectionPaginator
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public EloquentCollection|SupportCollection|null $collection
    ) {
        //
    }

    /**
     * Paginate the given query.
     *
     * @param  null  $page
     * @param  null  $total
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(\Closure|int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', $page = null, $total = null): LengthAwarePaginator
    {
        // Current page number
        $currentPage = $page ?: LengthAwarePaginator::resolveCurrentPage();

        $total = $total ?? $this->collection->count();

        // Define how many items you want to be visible in each page
        $perPage = ($perPage instanceof \Closure
            ? $perPage($total)
            : $perPage
        ) ?: 10;

        // Slice the collection to get the items for the current page
        //$currentPageItems = $this->collection->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $currentPageItems = $total
            ? $this->collection->slice(($currentPage - 1) * $perPage, $perPage)->values()
            : $this->collection;

        // Create paginator
        return new LengthAwarePaginator(
            $currentPageItems,
            $total,
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query(), 'pageName' => $pageName]
        );
    }
}
