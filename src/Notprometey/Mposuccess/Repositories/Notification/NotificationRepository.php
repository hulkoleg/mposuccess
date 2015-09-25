<?php namespace Notprometey\Mposuccess\Repositories\Notification;
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 10.09.2015
 * Time: 22:00
 */

use Notprometey\Mposuccess\Repositories\Repository;

class NotificationRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {

        return 'Notprometey\Mposuccess\Models\Notification';
    }

    public function newCount($value) {
        $this->applyCriteria();
        return $this->model->where('sid', '=', $value)->where('status', '=', 0)->count();
    }

    public function allCount($value) {
        $this->applyCriteria();
        return $this->model->where('sid', '=', $value)->count();
    }

    public function newNotification($value, $skip, $take) {
        $this->applyCriteria();
        return $this->model->where('sid', '=', $value)->skip($skip)->take($take)->get();
    }

}