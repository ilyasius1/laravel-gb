<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UsersQueryBuilder extends QueryBuilder
{

    public function getModel(): Builder
    {
        return User::query();
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->getModel()->paginate(50);
    }
}
