<?php

namespace App\Transformers\Polymorphics;

use League\Fractal\TransformerAbstract;
use App\Entities\Polymorphics\Attachment;

/**
 * Class AttachmentTransformer.
 *
 * @package namespace App\Transformers\Polymorphics;
 */
class AttachmentTransformer extends TransformerAbstract
{
    /**
     * Transform the Attachment entity.
     *
     * @param \App\Entities\Polymorphics\Attachment $model
     *
     * @return array
     */
    public function transform(Attachment $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
