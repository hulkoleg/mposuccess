<?php namespace Notprometey\Mposuccess\Repositories\User;
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 22.08.2015
 * Time: 11:08
 */

use Notprometey\Mposuccess\Repositories\Menu\Contract\MenuEloquent;
use Notprometey\Mposuccess\Repositories\RepositoryInterface;
use Notprometey\Mposuccess\Repositories\Repository;

class UserRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {

        return 'Notprometey\Mposuccess\Models\User';
    }

}