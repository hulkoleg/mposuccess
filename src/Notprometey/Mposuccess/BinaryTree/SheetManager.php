<?php
/**
 * Created by PhpStorm.
 * User: NotPrometey
 * Date: 15.09.2015
 * Time: 20:31
 */

namespace Notprometey\Mposuccess\BinaryTree;

use Notprometey\Mposuccess\Models\User;


/**
 * @property Sheet tree
 */
class SheetManager
{
    protected $builder;
    protected $sheet;
    protected $uid;
    protected $pid;
    protected $level;

    public function __construct($uid, $level){
        $this->uid = $uid;
        $this->level = $level;
    }

    public function create(){

        for($i=0; $i<300; $i++) {
            $users = User::all()->lists('id')->toArray();
            $refer = array_rand($users);
            $user = User::create([
                'sid' => 100001,
                'name' => 'company',
                'email' => 'company@mposuccess.ru'.$i,
                'password' => 'company',
                'refer' => $refer
            ]);
            $this->tree = new Sheet($this->level, $user->id);
            $this->tree->insert();
        }

        //$this->tree = new Sheet($this->level, $this->uid);
        //$this->tree->insert();


    }
}