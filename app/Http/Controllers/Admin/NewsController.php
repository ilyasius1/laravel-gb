<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Application|Factory|View
    {
        $model = app(News::class);
       // dd( $model->getNews(true));
        return view('admin.news.index', [
            'newsList' => $model->getNews(true)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'author' => ['required', 'string']
        ]);
        return response()->json($request->only(['title','author', 'status', 'description']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = app(News::class);
        dd($model->getNews($id));
        return view('admin.news.show', [
            'news' => $model->getNews($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
