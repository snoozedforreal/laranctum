<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

abstract class Filter
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * The builder instance.
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * The table name.
     *
     * @var string
     */
    protected $table;

    /**
     * Initialize a new filter instance.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the filters on the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->request->all() as $name => $value)
            if (method_exists($this, $name))
                // call user function array
                call_user_func_array([$this, $name], array_filter([$value]));

        return $this->builder;
    }

    /**
     * Sort the collection by the given order and field.
     *
     * @param  array  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function sort(array $value = [])
    {
        if (!isset($value['by']) || !Schema::hasColumn($this->table, $value['by']))
            // do not filter with this field
            return $this->builder;

        return $this->builder
            ->orderBy($value['by'], $value['order'] ?? 'desc');
    }
}
