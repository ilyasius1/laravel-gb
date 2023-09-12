<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsSource\Store;
use App\Http\Requests\NewsSource\Update;
use App\Models\Category;
use App\Models\NewsSource;
use App\Queries\CategoriesQueryBuilder;
use App\Queries\NewsQueryBuilder;
use App\Queries\NewsSourcesQueryBuilder;
use App\Queries\QueryBuilder;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NewsSourceController extends Controller
{
    protected QueryBuilder $categoriesQueryBuilder;
    protected QueryBuilder $newsSourcesQueryBuilder;

    public function __construct(
        CategoriesQueryBuilder $categoriesQueryBuilder,
        NewsSourcesQueryBuilder $newsSourcesQueryBuilder
    )
    {
        $this->categoriesQueryBuilder = $categoriesQueryBuilder;
        $this->newsSourcesQueryBuilder = $newsSourcesQueryBuilder;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.news-sources.index', [
            'newsSources' => $this->newsSourcesQueryBuilder->getAll()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.news-sources.create',[
            'categories' => $this->categoriesQueryBuilder->getAll()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request): RedirectResponse
    {
        $requestData = [...$request->validated(), 'is_active' => $request->boolean('is_active')];
        $newsSource = NewsSource::create($requestData);
        if($newsSource){
            return redirect()->route('admin.news-sources.index')->with('success', __('NewsSource has been created'));
        }
        return \back()->with('error', __('NewsSource has not been created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsSource $newsSource): Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.news-sources.show', ['newsSource' => $newsSource]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, NewsSource $newsSource): Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.news-sources.edit', [
            'newsSource' => $newsSource,
            'categories' => $this->categoriesQueryBuilder->getAll()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, NewsSource $newsSource): RedirectResponse
    {
        $requestData = [...$request->validated(), 'is_active' => $request->boolean('is_active')];
        $newsSource->fill($requestData);
        if($newsSource->save()){
            return redirect(route('admin.news-sources.index'))->with('success',  __('Profile has been updated'));
        }
        return back()->with('error', __('Error! News has not been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsSource $newsSource): JsonResponse
    {
        try {
            $newsSource->delete();
            return response()->json([
                'message'=> 'success', __('Resource has been deleted'),
                'lastPage' => route('admin.news-sources.index')
            ],200);
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
            return response()->json('error', 400);
        }
    }
}
