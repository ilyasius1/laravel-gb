<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * List all news
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $news = $this->getNews();
        return view('news.index', [
            'newsList' => $news
        ]);
    }


    /**
     * Returns current news
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show(int $id)
    {
        $news = $this->getNews($id);
        return view('news.show', [
            'news' => $news
        ]);
    }
}
