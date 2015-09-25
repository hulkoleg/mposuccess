<?php
/**
 * Created by PhpStorm.
 * User: NotPrometey
 * Date: 13.09.2015
 * Time: 17:38
 */

namespace Notprometey\Mposuccess\BinaryTree;


use Notprometey\Mposuccess\Contracts\BinaryTree\BuilderContract;
//use Notprometey\Mposuccess\Repositories\Tree\TreeRepository;

class SheetBuilder implements BuilderContract
{
    protected $sheet;

    public function __construct($sid){
        $this->sheet = new Sheet($sid);
    }

    public function getBuild(){
        return $this->sheet;
    }
}