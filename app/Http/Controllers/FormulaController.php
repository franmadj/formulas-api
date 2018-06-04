<?php

namespace App\Http\Controllers;

use App\Formula;
use Illuminate\Http\Request;
use Watson\Validating\ValidationException;
use Flugg\Responder\Facades\Responder;
use App\Http\Controllers\Controller;
use App\Transformers\FormulaTransformer;

class FormulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formulas = Formula::with('products')->get();
        return Responder::success($formulas, new FormulaTransformer)->respond();
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
            if (Formula::make($request->all()))
                return Responder::success();
            return Responder::error();
        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);
        } catch (\Exception $e) {
            return Responder::error($e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Formula  $formula
     * @return \Illuminate\Http\Response
     */
    public function edit(Formula $formula)
    {
        try {
            return Responder::success($formula, new FormulaTransformer)->respond();
        } catch (\Exception $e) {
            return Responder::error($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Formula  $formula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formula $formula)
    {
        try {
            if ($formula=Formula::updateFormula($request->all(), $formula))
                return Responder::success($formula, new FormulaTransformer)->respond();
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
     * @param  \App\Formula  $formula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formula $formula)
    {
        try {
            $result = $formula->delete();
            if ($result)
                return Responder::success();
            return Responder::error('Formula was not deleted! Try again!');
        } catch (\Exception $e) {
            return Responder::error($e->getMessage());
        }
    }
}
