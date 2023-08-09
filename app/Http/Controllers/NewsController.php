<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * List all news
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $model = app(News::class);
        return view('news.index', [
            'newsList' => $model->getNews()
        ]);
    }


    /**
     * Returns current news
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function show(int $id): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $model = app(News::class);
        return view('news.show', [
            'newsItem' => $model->getNewsById($id)
        ]);
    }
}
