<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;
use App\Events\NewKeywordEvent;
use Watson\Validating\ValidationException;
use Flugg\Responder\Facades\Responder;
use App\Http\Controllers\Controller;
use App\Transformers\ProviderTransformer;

class ProviderController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $providers = Provider::all();
        return Responder::success($providers, new ProviderTransformer)->respond();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            if (Provider::make($request->all()))
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
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider) {
        try {
            return Responder::success($provider, new ProviderTransformer)->respond();
        } catch (\Exception $e) {
            return Responder::error($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider) {
        try {
            if ($provider=Provider::updateProvider($request->all(), $provider))
                return Responder::success($provider, new ProviderTransformer)->respond();
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
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider) {
        try {
            $result = $provider->delete();
            if ($result)
                return Responder::success();
            return Responder::error('Provider was not deleted! Try again!');
        } catch (\Exception $e) {
            return Responder::error($e->getMessage());
        }
    }

}
