<?php

namespace App\Presenters\Polymorphics;

use App\Transformers\Polymorphics\AttachmentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AttachmentPresenter.
 *
 * @package namespace App\Presenters\Polymorphics;
 */
class AttachmentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AttachmentTransformer();
    }
}
