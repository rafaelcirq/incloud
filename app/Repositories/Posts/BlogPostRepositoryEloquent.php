<?php

namespace App\Repositories\Posts;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Posts\BlogPostRepository;
use App\Entities\Posts\BlogPost;
use App\Validators\Posts\BlogPostValidator;

/**
 * Class BlogPostRepositoryEloquent.
 *
 * @package namespace App\Repositories\Posts;
 */
class BlogPostRepositoryEloquent extends BaseRepository implements BlogPostRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BlogPost::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BlogPostValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
