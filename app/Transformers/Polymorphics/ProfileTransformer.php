<?php

namespace App\Transformers\Polymorphics;

use League\Fractal\TransformerAbstract;
use App\Entities\Polymorphics\Profile;

/**
 * Class ProfileTransformer.
 *
 * @package namespace App\Transformers\Polymorphics;
 */
class ProfileTransformer extends TransformerAbstract
{
    /**
     * Transform the Profile entity.
     *
     * @param \App\Entities\Polymorphics\Profile $model
     *
     * @return array
     */
    public function transform(Profile $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
