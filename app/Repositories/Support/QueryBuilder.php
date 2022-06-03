<?php

namespace App\Repositories\Support;

use Carbon\Carbon;
use Illuminate\Support\{Arr, LazyCollection};

class QueryBuilder implements QueryBuilderInterface
{
    /**
     * Property in the model.
     * 
     * @var string
     */
    protected $column;

    /**
     * Property type: date, string, numeric
     * 
     * @var string
     */
    protected $type;

    /**
     * Value in the query.
     * 
     * @var string|array
     */
    protected $item;

    /**
     * Query Builder instance
     * 
     * @var \Illuminate\Database\Query\Builder
     */
    protected $query;

    /**
     * Reverses the query condition.
     * 
     * @var bool
     */
    protected $inverse;

    /**
     * Indicates the use of where or orWhere clauses.
     * 
     * @var bool
     */
    protected $strict;

    /**
     * Handles whereNull and orWhereNull condition.
     * 
     * @var bool
     */
    protected $null;

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
    ) {
        $this->column = $column;
        $this->type = $type;
        $this->item = $item;
        $this->query = $query;
        $this->inverse = $inverse;
        $this->strict = $strict;
        $this->null = $null;

        $this->setMethods()
            ->setConditions();

        return $this->query;
    }

    /**
     * Set the methods for query conditions.
     * 
     * @return $this
     */
    protected function setMethods()
    {
        $this->where = $this->strict
            ? 'where'
            : 'orWhere';

        $this->whereBetween = $this->strict
            ? 'whereBetween'
            : 'orWhereBetween';

        $this->whereIn = $this->strict
            ? 'whereIn'
            : 'orWhereIn';

        $this->whereNotBetween = $this->strict
            ? 'whereNotBetween'
            : 'orWhereNotBetween';

        $this->whereNotIn = $this->strict
            ? 'whereNotIn'
            : 'orWhereNotIn';

        $this->whereNotNull = $this->strict
            ? 'whereNotNull'
            : 'orWhereNotNull';

        $this->whereNull = $this->strict
            ? 'whereNull'
            : 'orWhereNull';

        return $this;
    }

    /**
     * Set the conditions for the query builder.
     * 
     * @return void
     */
    protected function setConditions()
    {
        if (isset($this->null)) return $this->nullOrNotNull();

        switch ($this->type) {
            case 'date':
                $this->dateConditions();
                break;

            case 'numeric':
                $this->numericConditions();
                break;

            case 'string':
                $this->stringConditions();
                break;
        }
    }

    /**
     * Check if the condition is null or is not null.
     * 
     * @return void
     */
    protected function nullOrNotNull()
    {
        if ($this->null) {
            $this->query->{$this->whereNull}($this->column);
        } else {
            $this->query->{$this->whereNotNull}($this->column);
        }
        return;
    }

    /**
     * Set the conditions for date type.
     * 
     * @return void
     */
    protected function dateConditions()
    {
        if (!is_array($this->item)) {
            $this->inverse
                ? $this->query->{$this->where}($this->column, '!=', Carbon::parse($this->item))
                : $this->query->{$this->where}($this->column, Carbon::parse($this->item));

            return;
        }

        if (Arr::has($this->item, 'lessThan')) {
            $this->inverse
                ? $this->query->{$this->where}($this->column, '>', Carbon::parse(Arr::get($this->item, 'lessThan')))
                : $this->query->{$this->where}($this->column, '<', Carbon::parse(Arr::get($this->item, 'lessThan')));
        } else if (Arr::has($this->item, 'lessThanOrEqualTo')) {
            $this->inverse
                ? $this->query->{$this->where}($this->column, '>=', Carbon::parse(Arr::get($this->item, 'lessThanOrEqualTo')))
                : $this->query->{$this->where}($this->column, '<=', Carbon::parse(Arr::get($this->item, 'lessThanOrEqualTo')));
        } else if (Arr::has($this->item, 'greaterThan')) {
            $this->inverse
                ? $this->query->{$this->where}($this->column, '<', Carbon::parse(Arr::get($this->item, 'greaterThan')))
                : $this->query->{$this->where}($this->column, '>', Carbon::parse(Arr::get($this->item, 'greaterThan')));
        } else if (Arr::has($this->item, 'greaterThanOrEqualTo')) {
            $this->inverse
                ? $this->query->{$this->where}($this->column, '<=', Carbon::parse(Arr::get($this->item, 'greaterThanOrEqualTo')))
                : $this->query->{$this->where}($this->column, '>=', Carbon::parse(Arr::get($this->item, 'greaterThanOrEqualTo')));
        } else if (Arr::has($this->item, 'from') && Arr::has($this->item, 'to')) {
            $this->inverse
                ? $this->query->{$this->whereNotBetween}($this->column, [
                    Carbon::parse(Arr::get($this->item, 'from')),
                    Carbon::parse(Arr::get($this->item, 'to'))
                ])
                : $this->query->{$this->whereBetween}($this->column, [
                    Carbon::parse(Arr::get($this->item, 'from')),
                    Carbon::parse(Arr::get($this->item, 'to'))
                ]);
        } else {
            $dates = LazyCollection::make(function () {
                foreach ($this->item as $value) {
                    yield $value;
                }
            })->map(function ($date) {
                return Carbon::parse($date);
            });

            $this->inverse
                ? $this->query->{$this->whereNotIn}($this->column, $dates->all())
                : $this->query->{$this->whereIn}($this->column, $dates->all());
        }
    }

    /**
     * Set the conditions for numeric type.
     * 
     * @return void
     */
    protected function numericConditions()
    {
        if (!is_array($this->item)) {
            $this->inverse
                ? $this->query->{$this->where}($this->column, '!=', $this->item)
                : $this->query->{$this->where}($this->column, $this->item);

            return;
        }

        if (Arr::has($this->item, 'lessThan')) {
            $this->inverse
                ? $this->query->{$this->where}($this->column, '>', Arr::get($this->item, 'lessThan'))
                : $this->query->{$this->where}($this->column, '<', Arr::get($this->item, 'lessThan'));
        } else if (Arr::has($this->item, 'lessThanOrEqualTo')) {
            $this->inverse
                ? $this->query->{$this->where}($this->column, '>=', Arr::get($this->item, 'lessThanOrEqualTo'))
                : $this->query->{$this->where}($this->column, '<=', Arr::get($this->item, 'lessThanOrEqualTo'));
        } else if (Arr::has($this->item, 'greaterThan')) {
            $this->inverse
                ? $this->query->{$this->where}($this->column, '<', Arr::get($this->item, 'greaterThan'))
                : $this->query->{$this->where}($this->column, '>', Arr::get($this->item, 'greaterThan'));
        } else if (Arr::has($this->item, 'greaterThanOrEqualTo')) {
            $this->inverse
                ? $this->query->{$this->where}($this->column, '<=', Arr::get($this->item, 'greaterThanOrEqualTo'))
                : $this->query->{$this->where}($this->column, '>=', Arr::get($this->item, 'greaterThanOrEqualTo'));
        } else if (Arr::has($this->item, 'from') && Arr::has($this->item, 'to')) {
            $this->inverse
                ? $this->query->{$this->whereNotBetween}($this->column, [
                    Arr::get($this->item, 'from'),
                    Arr::get($this->item, 'to')
                ])
                : $this->query->{$this->whereBetween}($this->column, [
                    Arr::get($this->item, 'from'),
                    Arr::get($this->item, 'to')
                ]);
        } else {
            $this->inverse
                ? $this->query->{$this->whereNotIn}($this->column, $this->item)
                : $this->query->{$this->whereIn}($this->column, $this->item);
        }
    }

    /**
     * Set the conditions for string type.
     * 
     * @return void
     */
    protected function stringConditions()
    {
        if (!is_array($this->item)) {
            $this->inverse
                ? $this->query->{$this->where}($this->column, 'not like', $this->item . '%')
                : $this->query->{$this->where}($this->column, 'like', $this->item . '%');
        } else {
            $this->inverse
                ? $this->query->{$this->whereNotIn}($this->column, $this->item)
                : $this->query->{$this->whereIn}($this->column, $this->item);
        }
    }
}
