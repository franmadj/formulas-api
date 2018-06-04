<?php

namespace App\Transformers;

use App\Formula;
use Flugg\Responder\Transformers\Transformer;
use App\Transformers\ProductTransformer;

class FormulaTransformer extends Transformer {

    /**
     * A list of all available relations.
     *
     * @var array
     */
    protected $relations = ['products'];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = ['products'];

    /**
     * Transform the model data into a generic array.
     *
     * @param  Formula $formula
     * @return array
     */
    public function transform(Formula $formula): array {
        //return $formula->getAttributes();
        return [
            "id" => (int) $formula->id,
            "category_id" => $formula->category->name,
            "name" => $formula->name,
            "code" => $formula->code,
            "description" => $formula->description,
            "created_at" => $formula->created_at->format('Y-m-d'),
            "updated_at" => $formula->updated_at->format('Y-m-d'),
        ];
    }

    public function includeProducts(Formula $formula, $params) {

        return $this->resource($formula->products, new ProductTransformer());
    }

}
