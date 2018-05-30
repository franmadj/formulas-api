<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Events\NewKeywordEvent;
use Watson\Validating\ValidationException;
use Flugg\Responder\Facades\Responder;
use App\Http\Controllers\Controller;
use App\Transformers\CategoryTransformer;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return Responder::success($categories, new CategoryTransformer)->respond();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (Category::make($request->all()))
                return Responder::success();
            return Responder::error();
        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);
        } catch (\Exception $e) {
            return Responder::error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        try {
            return Responder::success($category, new CategoryTransformer)->respond();
        } catch (\Exception $e) {
            return Responder::error($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {
            if ($category=Category::updateCategory($request->all(), $category))
                return Responder::success($category, new CategoryTransformer)->respond();
            return Responder::error();
        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);
        } catch (\Exception $e) {
            return Responder::error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $result = $category->delete();
            if ($result)
                return Responder::success();
            return Responder::error('Category was not deleted! Try again!');
        } catch (\Exception $e) {
            return Responder::error($e->getMessage());
        }
    }
}
