<?php

namespace App\Transformers;

use App\Product;
use Flugg\Responder\Transformers\Transformer;

class ProductTransformer extends Transformer
{


    /**
     * Transform the model data into a generic array.
     *
     * @param  Birthday $birthday
     * @return array
     */
    public function transform(Product $product):array
    {
        return $product->getAttributes();
    }
}
