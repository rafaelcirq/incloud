<?php

namespace App\Repositories\Polymorphics;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Polymorphics\ProfileRepository;
use App\Entities\Polymorphics\Profile;
use App\Validators\Polymorphics\ProfileValidator;

/**
 * Class ProfileRepositoryEloquent.
 *
 * @package namespace App\Repositories\Polymorphics;
 */
class ProfileRepositoryEloquent extends BaseRepository implements ProfileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Profile::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ProfileValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
