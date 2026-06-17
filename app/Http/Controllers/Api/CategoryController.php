<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $search=request('search');

        $categories=Category::when(
            $search,
            fn($q)=>$q->where(
                'name',
                'ILIKE',
                "%{$search}%"
            )
        )
        ->latest()
        ->paginate(10);

        return CategoryResource::collection(
            $categories
        );
    }

    public function store(
        CategoryStoreRequest $request
    )
    {
        $category=Category::create([

            'name'=>$request->name,
        ]);

        return response()->json([
            'success'=>true,
            'data'=>new CategoryResource(
                $category
            )
        ],201);
    }

    public function show(Category $category)
    {
        return new CategoryResource(
            $category
        );
    }

    public function update(
        CategoryUpdateRequest $request,
        Category $category
    )
    {
        $category->update([

            'name'=>$request->name,
        ]);

        return response()->json([
            'success'=>true,
            'data'=>new CategoryResource(
                $category
            )
        ]);
    }

    public function destroy(
        Category $category
    )
    {
        $category->delete();

        return response()->json([
            'success'=>true,
            'message'=>'Category deleted'
        ]);
    }
}
