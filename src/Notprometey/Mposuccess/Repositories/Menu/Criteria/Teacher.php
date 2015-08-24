<?php namespace Notprometey\Mposuccess\Repositories\Menu\Criteria;
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 22.08.2015
 * Time: 13:23
 */

use Notprometey\Mposuccess\Repositories\RepositoryInterface as Repository;
use Notprometey\Mposuccess\Repositories\Criteria\Criteria;

class Teacher extends  Criteria {

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $query = $model->where('enable', '=', 1);
        return $query;
    }
}