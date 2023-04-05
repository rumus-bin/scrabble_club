<?php

namespace App\Core\Database;

use Illuminate\Database\Eloquent\Builder;

interface QueryModifierInterface
{
    public function modify(Builder $builder);
}
