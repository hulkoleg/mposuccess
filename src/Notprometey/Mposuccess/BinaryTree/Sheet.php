<?php namespace Notprometey\Mposuccess\BinaryTree;

use Notprometey\Mposuccess\Contracts\BinaryTree\SheetInterface;
use Notprometey\Mposuccess\Repositories\Tree\TreeRepository;

/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 22.08.2015
 * Time: 10:42
 */


class Sheet implements SheetInterface {

    protected $sid;

    protected $left;

    protected $right;

    protected $user;

    protected $line;

    protected $side;

    protected $two;

    protected $parent;

    protected $level;

    protected $tree;

    /**
     * @param App        $app
     * @param Collection $collection
     */
    public function __construct($level, $uid = null, $sid = null){
        $this->sid = $sid;
        $this->level = $level;

        TreeRepository::setTable('Notprometey\Mposuccess\Models\Tree');
        $this->tree = app('Notprometey\Mposuccess\Repositories\Tree\TreeRepository');
        $this->user = app('Notprometey\Mposuccess\Repositories\User\UserRepository');

        if(!empty($uid)) {
            $this->user = $this->user->find($uid);
            $this->parent = $this->user->refer;
        }

        if(!empty($this->sid)){
            $this->left = $this->tree->find($this->sid * 2);
            $this->right = $this->tree->find(($this->sid * 2) + 1);
            $this->line = log($this->sid, 2);
            $this->side = ($this->sid%2)?0:1;


            if(!empty($this->left)){
                $this->two[0] = $this->tree->find($this->sid * 4);
                $this->two[1] = $this->tree->find(($this->sid * 4) + 1);
            }else{
                $this->two[0] = null;
                $this->two[1] = null;
            }

            if(!empty($this->right)){
                $this->two[2] = $this->tree->find((($this->sid * 2) + 1) * 2);
                $this->two[3] = $this->tree->find(((($this->sid * 2) + 1) * 2) + 1);
            }else{
                $this->two[2] = null;
                $this->two[3] = null;
            }

        }
    }

    public function insert()
    {

        if ($response = $this->tree->findBy('user_id', $this->user->id)) {
            return $this->insertUnder();
        }

        $sid = $this->find($this->parent);

        if(is_null($sid)){
            $sid = $this->tree->findIMindByUser();
        }

        $max = $this->tree->findIMaxId();

        if($sid > $max){
            for($i = $max + 1; $i < $sid; $i++){
                $this->tree->create([
                    'user_id' => null,
                    'id'      => $i
                ]);
            }
        }

        $this->tree->create([
            'user_id' => $this->user->id,
            'id'      => $sid
        ]);
    }

    public function insertUnder(){

    }

    public function remove($key){

    }

    protected function init(){
    }

    private function find($id){
        $places = $this->tree->findIdByUser($id);
        $sid = null;

        foreach ($places as $place) {
            $sheet = new Sheet($this->level, $place->user_id, $place->id);
            if (empty($sheet->left) || empty($sheet->right) || in_array(null, $sheet->two)) {
                if (empty($sheet->left)) {
                    $sid = $sheet->sid * 2;
                } elseif (empty($sheet->right)) {
                    $sid = ($sheet->sid * 2) + 1;
                } else {
                    foreach ($sheet->two as $key => $place) {
                        if (empty($place)) {
                            $sid = ($sheet->sid * 4) + $key;
                            break;
                        }
                    }
                }
                break;
            }
        }

        if(is_null($sid)){
            $user = $this->user->find($id);
            if(!empty($user)) {
                $sid = $this->find($user->refer);
            }
        }

        return $sid;
    }
}