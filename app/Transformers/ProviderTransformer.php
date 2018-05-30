<?php

namespace App\Transformers;

use App\Provider;
use Carbon\Carbon;
use Flugg\Responder\Transformers\Transformer;

class ProviderTransformer extends Transformer
{
    /**
     * A list of all available relations.
     *
     * @var array
     */
    protected $relations = ['*'];

    /**
     * Transform the model data into a generic array.
     *
     * @param  Birthday $birthday
     * @return array
     */
    public function transform(Provider $provider):array
    {
        return $provider->getAttributes();
    }
}
