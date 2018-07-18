<?php

namespace App\Presenters\Posts;

use App\Transformers\Posts\BlogPostTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BlogPostPresenter.
 *
 * @package namespace App\Presenters\Posts;
 */
class BlogPostPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BlogPostTransformer();
    }
}
