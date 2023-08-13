<?php

declare(strict_types=1);

namespace App\Queries;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

abstract class QueryBuilder
{
    abstract public function getModel(): Builder;

    abstract public function getAll(): Collection | LengthAwarePaginator;
}
