<?php

namespace App\Transformers;

use App\Product;
use Flugg\Responder\Transformers\Transformer;

class ProductTransformer extends Transformer {

    /**
     * Transform the model data into a generic array.
     *
     * @param  Product $product
     * @return array
     */
    public function transform(Product $product): array {
        return [
            "id" => $product->id,
            "name" => $product->name,
            "code" => $product->code,
            "price" => $product->price,
            "density" => $product->density,
            "created_at" => $product->created_at->format('Y-m-d'),
            "updated_at" => $product->updated_at->format('Y-m-d'),
        ];
    }

}
