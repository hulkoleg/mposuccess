<?php namespace Notprometey\Mposuccess\Repositories\News;
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 15.09.2015
 * Time: 22:00
 */

use Notprometey\Mposuccess\Repositories\Repository;

class NewsRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {

        return 'Notprometey\Mposuccess\Models\News';
    }

}