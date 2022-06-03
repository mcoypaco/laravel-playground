<?php

namespace App\Repositories\Support;

interface QueryBuilderInterface
{
    /**
     * Builds the conditions for the query.
     *
     * @param string $column
     * @param string $type
     * @param string|array $item
     * @param \Illuminate\Database\Query\Builder $query
     * @param bool $inverse
     * @param bool|null $null
     * @return \Illuminate\Database\Query\Builder $query
     */
    public function query(
        $column,
        $type,
        $item,
        $query,
        $inverse = false,
        $strict = false,
        $null
    );
}
