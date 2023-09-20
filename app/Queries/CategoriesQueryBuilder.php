<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoriesQueryBuilder extends QueryBuilder
{

    public function getModel(): Builder
    {
        return Category::query();
    }

    public function getAll(): Collection
    {
        return $this->getModel()->get();
    }

    public function getPaginate(): LengthAwarePaginator
    {
        return $this->getModel()->paginate(10);
    }
}
