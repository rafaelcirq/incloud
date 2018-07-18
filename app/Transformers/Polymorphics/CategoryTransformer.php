<?php

namespace App\Transformers\Polymorphics;

use League\Fractal\TransformerAbstract;
use App\Entities\Polymorphics\Category;

/**
 * Class CategoryTransformer.
 *
 * @package namespace App\Transformers\Polymorphics;
 */
class CategoryTransformer extends TransformerAbstract
{
    /**
     * Transform the Category entity.
     *
     * @param \App\Entities\Polymorphics\Category $model
     *
     * @return array
     */
    public function transform(Category $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
