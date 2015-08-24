<?php namespace Notprometey\Mposuccess\Repositories\Menu\Contract;
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 22.08.2015
 * Time: 11:19
 */

use Notprometey\Mposuccess\Repositories\RepositoryInterface;
use Notprometey\Mposuccess\Repositories\Repository;

abstract class MenuEloquent extends Repository implements MenuInterface
{
    public function with($name = '') {
        $this->applyCriteria();
        return $this->model->with($name)->get();
    }
}