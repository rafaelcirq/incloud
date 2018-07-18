<?php

namespace App\Presenters\Polymorphics;

use App\Transformers\Polymorphics\AffiliateTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AffiliatePresenter.
 *
 * @package namespace App\Presenters\Polymorphics;
 */
class AffiliatePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AffiliateTransformer();
    }
}
