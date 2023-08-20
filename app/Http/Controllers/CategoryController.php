<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Queries\CategoriesQueryBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(CategoriesQueryBuilder $categoriesQueryBuilder): View
    {
        return view('category.index', [
            'categories' => $categoriesQueryBuilder->getAll()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        return view('category.show', [
            'category' => $category
        ]);
    }
}
