<?php namespace Notprometey\Mposuccess\Contracts\BinaryTree;
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 22.08.2015
 * Time: 10:42
 */


interface SheetInterface {
    public function insert();
    public function remove($key);
}