<?php

namespace App\Http\Controllers\Api;

use App\Actions\CategoryActions;
use App\Http\Controllers\Controller;
use App\Http\Middleware\CORS;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Category\AllCategoriesResource;
use App\Http\Resources\Category\CategoryStylesResource;
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(CORS::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\Category\AllCategoriesResource
     */
    public function index()
    {
        return AllCategoriesResource::collection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CategoryRequest  $request
     * @return App\Http\Resources\Category\CategoryStylesResource
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        CategoryActions::create($category);

        return new CategoryStylesResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\Category\CategoryStylesResource
     */
    public function show(Category $category)
    {
        return new CategoryStylesResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CategoryRequest  $request
     * @param  int  $id
     * @return App\Http\Resources\Category\CategoryStylesResource
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return new CategoryStylesResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        CategoryActions::delete($category);
        $category->delete();

        return response()->json([
            "message" => "Category deleted",
            "status" => Response::HTTP_NO_CONTENT
        ]);
    }
}
