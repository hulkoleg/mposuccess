<?php namespace Notprometey\Mposuccess\BinaryTree;

use Notprometey\Mposuccess\Contracts\BinaryTree\SheetInterface;
use Notprometey\Mposuccess\Repositories\Tree\TreeRepository;
use Event;

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

    public $user;

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

        TreeRepository::setTable('Notprometey\Mposuccess\Models\Tree' . $level);
        $this->tree = app('Notprometey\Mposuccess\Repositories\Tree\TreeRepository');
        $this->user = app('Notprometey\Mposuccess\Repositories\User\UserRepository');

        if(!empty($uid)) {
            $this->user = $this->user->find($uid);
            $this->parent = $this->user->refer;
        }

        if(!empty($this->sid)){
            $this->left = $this->tree->findUser($this->sid * 2);
            $this->right = $this->tree->findUser(($this->sid * 2) + 1);

            $this->line = log($this->sid, 2);
            $this->side = ($this->sid%2)?0:1;


            if(!empty($this->left)){
                $this->two[0] = $this->tree->findUser($this->sid * 4);
                $this->two[1] = $this->tree->findUser(($this->sid * 4) + 1);
            }else{
                $this->two[0] = null;
                $this->two[1] = null;
            }

            if(!empty($this->right)){
                $this->two[2] = $this->tree->findUser((($this->sid * 2) + 1) * 2);
                $this->two[3] = $this->tree->findUser(((($this->sid * 2) + 1) * 2) + 1);
            }else{
                $this->two[2] = null;
                $this->two[3] = null;
            }
        }
    }

    public function insert()
    {
        $sid = null;

        if ($response = $this->tree->findAllBy('user_id', $this->user->id)) {
            $sid = $this->findVacancy($response);
        }

        if(is_null($sid)) {
            $sid = $this->find($this->parent);
        }

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

        $current = $this->tree->find($sid);

        if(is_null($current)) {
            $create = $this->tree->create([
                'user_id' => $this->user->id,
                'id' => $sid
            ]);
        } else {
            $create = $this->tree->update([
                'user_id' => $this->user->id,

            ],$sid);
        }

        if(1 == $this->level) {
            Event::fire('tree.one.bye', [
                trim($this->user->surname . ' ' . $this->user->name . " (" . $this->user->email . ")"),
                $sid,
                $this->user->id,
                $this->user->refer
            ]);
        } elseif(2 == $this->level) {
            Event::fire('tree.two.bye', [
                trim($this->user->surname . ' ' . $this->user->name . " (" . $this->user->email . ")"),
                $sid,
                $this->user->id,
                $this->user->refer
            ]);
        } elseif(3 == $this->level) {
            Event::fire('tree.three.bye', [
                trim($this->user->surname . ' ' . $this->user->name . " (" . $this->user->email . ")"),
                $sid,
                $this->user->id,
                $this->user->refer
            ]);
        }

        return $create;
    }

    public function remove($key){

    }

    protected function init(){
    }

    private function find($id){
        $places = $this->tree->findIdByUser($id);
        $sid = null;

        $sid = $this->findVacancy($places);

        if(is_null($sid)){
            $user = $this->user->find($id);
            if(!empty($user)) {
                $sid = $this->find($user->refer);
            }
        }

        return $sid;
    }

    private function findVacancy($places){
        $sid = null;
        foreach ($places as $place) {
            $sheet = new Sheet($this->level, $place->user_id, $place->id);
            if (empty($sheet->left)) {
                $sid = $sheet->sid * 2;
                break;
            } elseif (empty($sheet->right)) {
                $sid = ($sheet->sid * 2) + 1;
                break;
            } else {
                foreach ($sheet->two as $key => $place) {
                    if (empty($place)) {
                        $sid = ($sheet->sid * 4) + $key;
                        break;
                    }
                }
            }
        }
        return $sid;
    }

    /**
     * @return mixed
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @return mixed
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getTwo($key)
    {
        return $this->two[$key];
    }

    /**
     * @return null
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * @return null
     */
    public function getParent()
    {
        return ($this->sid%2)?($this->sid - 1)/2:$this->sid/2;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }



    public function toArray(){
        return [
            'current'   => [$this->user->id, $this->getParent(), $this->level],
            'one'       => [$this->left, $this->sid * 2, $this->level],
            'two'       => [$this->right, ($this->sid * 2) + 1, $this->level],
            'three'     => [$this->two[0], $this->sid * 4, $this->level],
            'four'      => [$this->two[1], ($this->sid * 4) + 1, $this->level],
            'five'      => [$this->two[2], ($this->sid * 4) + 2, $this->level],
            'six'       => [$this->two[3], ($this->sid * 4) + 3, $this->level],
        ];
    }

}