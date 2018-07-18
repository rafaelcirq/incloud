<?php

namespace App\Presenters\Posts;

use App\Transformers\Posts\SliderTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SliderPresenter.
 *
 * @package namespace App\Presenters\Posts;
 */
class SliderPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SliderTransformer();
    }
}
