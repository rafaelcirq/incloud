<?php

namespace App\Transformers\Posts;

use League\Fractal\TransformerAbstract;
use App\Entities\Posts\BlogPost;

/**
 * Class BlogPostTransformer.
 *
 * @package namespace App\Transformers\Posts;
 */
class BlogPostTransformer extends TransformerAbstract
{
    /**
     * Transform the BlogPost entity.
     *
     * @param \App\Entities\Posts\BlogPost $model
     *
     * @return array
     */
    public function transform(BlogPost $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
