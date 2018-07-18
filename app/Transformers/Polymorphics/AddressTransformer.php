<?php

namespace App\Transformers\Polymorphics;

use League\Fractal\TransformerAbstract;
use App\Entities\Polymorphics\Address;

/**
 * Class AddressTransformer.
 *
 * @package namespace App\Transformers\Polymorphics;
 */
class AddressTransformer extends TransformerAbstract
{
    /**
     * Transform the Address entity.
     *
     * @param \App\Entities\Polymorphics\Address $model
     *
     * @return array
     */
    public function transform(Address $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
