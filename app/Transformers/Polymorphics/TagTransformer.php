<?php

namespace App\Transformers\Polymorphics;

use League\Fractal\TransformerAbstract;
use App\Entities\Polymorphics\Tag;

/**
 * Class TagTransformer.
 *
 * @package namespace App\Transformers\Polymorphics;
 */
class TagTransformer extends TransformerAbstract
{
    /**
     * Transform the Tag entity.
     *
     * @param \App\Entities\Polymorphics\Tag $model
     *
     * @return array
     */
    public function transform(Tag $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
