<?php namespace Notprometey\Mposuccess\Repositories\Tree;
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 22.08.2015
 * Time: 11:08
 */

use Notprometey\Mposuccess\Repositories\Repository;
use Notprometey\Mposuccess\Models\Tree;

class TreeRepository extends Repository{

    public function findIdByUser($key){
        return $this->model->where('user_id',$key)->orderBy('id', 'ASC')->get();
    }
    public function findIMindByUser(){
        if(is_null($sid = $this->model->where('user_id',null)->min('id'))){
            $sid = $this->model->max('id');
            $sid++;
        }
        return $sid;
    }

    public function findUser($id, $columns = array('*')){
        $this->applyCriteria();
        return $this->model->find($id, $columns)->pluck('user_id');
    }

    public function findIMaxId(){
        return $this->model->max('id');
    }
    public function findByChild($key){

    }

    public function findByVacancy($key){

    }

    /**
     * Specify Model class name
     *
     *
     * @return mixed
     */
    public function model()
    {
        //return 'Notprometey\Mposuccess\Models\Tree';
        return self::$table;
    }

    public function getSheet($sid, $data){

    }

    public function setSheet($sid){

    }
}