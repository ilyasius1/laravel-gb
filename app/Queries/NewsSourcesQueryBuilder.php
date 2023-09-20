<?php

namespace App\Queries;

use App\Models\NewsSource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class NewsSourcesQueryBuilder extends QueryBuilder
{

    public function getModel(): Builder
    {
        return NewsSource::query();
    }

    public function getActive()
    {
        return $this->getModel()->active()->get();
    }


    public function getAll(): Collection
    {
        return $this->getModel()->with('category')->get();
    }

    public function find(string $id)
    {
        return $this->getModel()->find($id);
    }

    public function findMany(array $ids)
    {
        return $this->getModel()->findMany($ids);
    }
}
