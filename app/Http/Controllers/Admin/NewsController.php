<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\Store;
use App\Http\Requests\News\Update;
use App\Models\News;
use App\Queries\CategoriesQueryBuilder;
use App\Queries\NewsQueryBuilder;
use App\Queries\QueryBuilder;
use App\Services\Contracts\Upload;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

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
     * Display a listing of the resource.
     */
    public function index(): Application|Factory|View
    {
        return view('admin.news.index', [
            'newsList' => $this->newsQueryBuilder->getPaginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.news.create', [
            'categories' => $this->categoriesQueryBuilder->getAll()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request, Upload $upload): RedirectResponse
    {
        $news = News::create($request->validated());
        if($request->hasFile('image')) {
            $news['image'] = $upload->create($request->file('image'));
        }
        if($news) {
            $news->categories()->attach($request->getCategories());
            return redirect()->route('admin.news.index',[
                'page' =>  $this->newsQueryBuilder->getAll()->lastPage()
            ],201)->with('success', __('News has been created'));
        }
        return \back()->with('error', __('News has not been created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news): View
    {
        return view('admin.news.show', [
            'news' => $news
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news): View
    {
        return view('admin.news.edit', [
            'news' => $news,
            'categories' => $this->categoriesQueryBuilder->getAll()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, News $news, Upload $upload): RedirectResponse
    {
        $news = $news->fill($request->validated());
        if($request->hasFile('image')) {
            $news['image'] = $upload->create($request->file('image'));
        }
        if($news->save()){
            $news->categories()->sync($request->getCategories());
            return \redirect()->route('admin.news.index')->with('success', __('News has been updated'));
        }
        return \back()->with('error', __('News has not been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news): Response
    {
        try {
            $news->delete();
            return \response()->json([
                'message'=> 'success', __('Resource has been deleted'),
                'lastPage' => route('admin.news.index') . '/?page=' . $this->newsQueryBuilder->getAll()->lastPage()
            ], 200);
        } catch (\Throwable $exception) {
            \Log::error($exception->getMessage(), $exception->getTrace());
            return \response()->json('error', 400);
        }

    }
}
