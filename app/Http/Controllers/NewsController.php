<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\NewsStatus;
use App\Models\News;
use App\Queries\CategoriesQueryBuilder;
use App\Queries\NewsQueryBuilder;
use App\Queries\QueryBuilder;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class NewsController extends Controller
{
    protected QueryBuilder $categoriesQueryBuilder;
    protected QueryBuilder $newsQueryBuilder;

    public function __construct(
        CategoriesQueryBuilder $categoriesQueryBuilder,
        NewsQueryBuilder $newsQueryBuilder
    )
    {
        $this->categoriesQueryBuilder = $categoriesQueryBuilder;
        $this->newsQueryBuilder = $newsQueryBuilder;
    }
    /**
     * List all news
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $news = $this->newsQueryBuilder->getActiveNews();
        return view('news.index', [
            'newsList' => $news
        ]);
    }


    /**
     * Returns current news
     * @param News $news
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function show(News $news): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('news.show', [
            'news' => $news
        ]);
    }
}
