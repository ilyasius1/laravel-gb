<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Queries\CategoriesQueryBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoriesQueryBuilder $categoriesQueryBuilder)
    {
        return view('admin.categories.index', [
            'categoriesList' => $categoriesQueryBuilder->getAll()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\View\View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Category $category): RedirectResponse
    {
        ($request->all());
        $request->validate([
            'title' => ['required', 'string'],
        ]);
        $requestCategoryData = $request->only(['title','author','status', 'description']);

        $category->fill($requestCategoryData);
        if($category->save()){
            $category->save();
            return redirect(route('admin.categories.index'), status: 201)->with('success','Category has been created');
        }
        return back()->with('Error! News has not been crated');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        return view('admin.categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $category->fill($request->only('title','description'));
        if($category->save()){
            return \redirect()->route('admin.categories.index')->with('success', __('Category has been updated'));
        }
        return back()->with('error','Error! Category has not been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Category $category): Response
    {
        try {
            $category->delete();
                return response('Resource has been deleted', 204)->json([
                    'message' => '',
                    'lastPage' => route('admin.categories.index') . '/?page=' . $this->newsQueryBuilder->getAll()->lastPage()
                ]);
        } catch(\Throwable $exception) {
            \Log::error($exception->getMessage(), $exception->getTrace());
            return \back()->with('Error! News has not been deleted');
        }
    }
}
