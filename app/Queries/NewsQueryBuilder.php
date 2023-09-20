<?php

namespace App\Queries;

use App\Models\News;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class NewsQueryBuilder extends QueryBuilder
{

    public function getModel(): Builder
    {
        return News::query();
    }

    public function getActiveNews()
    {
        return $this->getModel()->active()->get();
    }

    public function getDraftNews()
    {
        return $this->getModel()->draft()->get();
    }

    public function getBlockedNews(): Collection
    {
        return $this->getModel()->blocked()->get();
    }

    public function getAll(): Collection
    {
        return $this->getModel()->with('categories')->get();
    }

    public function getPaginate(): LengthAwarePaginator
    {
        return $this->getModel()->with('categories')->paginate(10);
    }
}
