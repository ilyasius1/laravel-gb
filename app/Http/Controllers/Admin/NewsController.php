<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Queries\CategoriesQueryBuilder;
use App\Queries\NewsQueryBuilder;
use App\Queries\QueryBuilder;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            'newsList' => $this->newsQueryBuilder->getAll()
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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string'],
            'author' => ['required', 'string']
        ]);
        $categories = $request->input('categories');
        $requestNewsData = $request->only(['title','author','status', 'description']);
        $news = News::create($requestNewsData);
        if($news !== false) {
            if($categories !== null) {
                $news->categories()->attach($categories);
            }
            return redirect()->route('admin.news.index',[
                'page' =>  $this->newsQueryBuilder->getAll()->lastPage()
            ],201)->with('success','News has been crated');
        }
        return \back()->with('Error! News has not been crated');
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
    public function update(Request $request, News $news): RedirectResponse
    {
        $categories = $request->input('categories');
        $news = $news->fill($request->only(['title','author','status', 'description']));
        if($news->save()){
            $news->categories()->sync($categories);
            return \redirect()->route('admin.news.index')->with('success','News has been created');
        }
        return \back()->with('error', 'Error! News has not been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news): Response
    {
        if($news->delete()){
            return \response()->json([
                'message'=> 'success','News has been created',
                'lastPage' => route('admin.news.index') . '/?page=' . $this->newsQueryBuilder->getAll()->lastPage()
            ]);

        }
        return \back()->with('Error! News has not been deleted');
    }
}
