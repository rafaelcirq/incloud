<?php

namespace App\Presenters\Polymorphics;

use App\Transformers\Polymorphics\ProfileTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProfilePresenter.
 *
 * @package namespace App\Presenters\Polymorphics;
 */
class ProfilePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProfileTransformer();
    }
}
