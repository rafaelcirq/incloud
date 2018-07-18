<?php

namespace App\Presenters\Posts;

use App\Transformers\Posts\PageTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PagePresenter.
 *
 * @package namespace App\Presenters\Posts;
 */
class PagePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PageTransformer();
    }
}
