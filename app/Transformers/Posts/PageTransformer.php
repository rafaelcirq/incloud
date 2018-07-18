<?php

namespace App\Transformers\Posts;

use League\Fractal\TransformerAbstract;
use App\Entities\Posts\Page;

/**
 * Class PageTransformer.
 *
 * @package namespace App\Transformers\Posts;
 */
class PageTransformer extends TransformerAbstract
{
    /**
     * Transform the Page entity.
     *
     * @param \App\Entities\Posts\Page $model
     *
     * @return array
     */
    public function transform(Page $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
