<?php

namespace App\Http\Filters;

use Illuminate\Support\Facades\DB;

class UserFilter extends Filter
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Filter by the given name.
     *
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function name($name = null)
    {
        if (empty($name))
            // do not filter with this field
            return $this->builder;

        // expression
        $nameExpression = DB::raw("concat({$this->table}.first_name, ' ', {$this->table}.last_name)");

        return $this->builder
            ->where($nameExpression, 'like', '%' . $name . '%');
    }
}
