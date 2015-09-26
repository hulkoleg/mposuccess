<?php namespace Notprometey\Mposuccess\Repositories\Tree;
/**
 * Created by PhpStorm.
 * User: yan4ik
 * Date: 26.09.15
 * Time: 2:38
 */

use Notprometey\Mposuccess\Repositories\Repository;

class TreeSettingsRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {

        return 'Notprometey\Mposuccess\Models\TreeSetting';
    }

    public function getParamAndGroupLevel($response = array()){
        foreach($this->model->all() as $row) {
            if(!isset($response[$row->level])) {
                $response[$row->level] = array();
            }
            $response[$row->level][$row->param] = $row->value;
        }
        return $response;
    }

}