<?php

namespace App\Transformers;

use App\Category;
use Flugg\Responder\Transformers\Transformer;

class CategoryTransformer extends Transformer
{


    /**
     * Transform the model data into a generic array.
     *
     * @param  Birthday $birthday
     * @return array
     */
    public function transform(Category $category):array
    {
        return $category->getAttributes();
    }
}
