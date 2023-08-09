<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    /**
     * @return Collection
     */
    public function getNews(bool $isJoin = false): Collection
    {
        if($isJoin === true){
            return DB::table($this->table)
                ->select('news.*', 'categories.id as categoryId', 'categories.title as categoryTitle')
                ->join('category_has_news', 'category_has_news.news_id', '=', 'news.id')
                ->leftJoin('categories', 'category_has_news.category_id', '=', 'categories.id')
                ->get();
        }
        return DB::table($this->table)->get();
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Query\Builder|mixed
     */
    public function getNewsById(int $id): mixed
    {
        return DB::table($this->table)->find($id);
    }
}
