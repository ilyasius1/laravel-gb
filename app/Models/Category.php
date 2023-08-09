<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public function getCategories(): Collection
    {
        return DB::table($this->table)->get();
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Query\Builder|mixed
     */
    public function getCategoryById(int $id): mixed
    {
        return DB::table($this->table)->find($id);
    }
}
