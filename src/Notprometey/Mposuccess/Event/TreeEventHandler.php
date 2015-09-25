<?php
/**
 * Created by PhpStorm.
 * User: NotPrometey
 * Date: 23.09.2015
 * Time: 20:42
 */
namespace Notprometey\Mposuccess\Event;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notprometey\Mposuccess\BinaryTree\Sheet;
use Notprometey\Mposuccess\Models\Notification;
use Notprometey\Mposuccess\Repositories\Tree\TreeRepository;
use Notprometey\Mposuccess\Repositories\User\UserRepository;

class TreeEventHandler {//implements ShouldQueue {
    //use InteractsWithQueue;

    private $one = 1;
    private $two = 2;
    private $three = 3;
    private $four = 4;
    private $five = 4;
    private $six = 4;
    /**
     * @var TreeRepository
     */
    private $tree;

    /**
     * @var UserRepository
     */
    private $user;

    private $start = 3;
    private $interval = 4;
    private $next = 6;

    private $number = 2;

    public function __construct(){
        $this->user = app('Notprometey\Mposuccess\Repositories\User\UserRepository');
    }

    /**
     * @param $name
     * @param $sid
     * @param $uid
     * @param $pid
     *
     * @internal param $event
     */
    public function onTreeOneBye($name, $sid, $uid, $pid)
    {
        $this->onTreeBye($name, $sid, $uid, $pid, $this->one, $this->two);
    }

    /**
     * @param $name
     * @param $sid
     * @param $uid
     * @param $pid
     *
     * @internal param $event
     */
    public function onTreeTwoBye($name, $sid, $uid, $pid)
    {
        $this->onTreeBye($name, $sid, $uid, $pid, $this->two, $this->three);
    }

    /**
     * @param $name
     * @param $sid
     * @param $uid
     * @param $pid
     *
     * @internal param $event
     */
    public function onTreeThreeBye($name, $sid, $uid, $pid)
    {
        $this->onTreeBye($name, $sid, $uid, $pid, $this->three, $this->three);
    }

    /**
     * @param $name
     * @param $sid
     * @param $uid
     * @param $pid
     *
     * @internal param $event
     */
    public function onTreeFourBye($name, $sid, $uid, $pid)
    {
        $this->onTreeBye($name, $sid, $uid, $pid, $this->four, $this->five);
    }

    /**
     * @param $name
     * @param $sid
     * @param $uid
     * @param $pid
     *
     * @internal param $event
     */
    public function onTreeFiveBye($name, $sid, $uid, $pid)
    {
        $this->onTreeBye($name, $sid, $uid, $pid, $this->five, $this->six);
    }

    /**
     * @param $name
     * @param $sid
     * @param $uid
     * @param $pid
     *
     * @internal param $event
     */
    public function onTreeSixBye($name, $sid, $uid, $pid)
    {
        $this->onTreeBye($name, $sid, $uid, $pid, $this->six, $this->six);
    }

    /**
     * @param $name
     * @param $sid
     * @param $uid
     * @param $pid
     * @param $current
     * @param $next
     */
    private function onTreeBye($name, $sid, $uid, $pid, $current, $next){
        TreeRepository::setTable('Notprometey\Mposuccess\Models\Tree' . $current);
        $this->tree = app('Notprometey\Mposuccess\Repositories\Tree\TreeRepository');

        $this->addNotificationEndBye($uid, $pid, $name, $current, $sid);

        if(! ($current%3)) {
            switch ($this->next) {
                case 1:
                    $sid = $sid / 2;
                    break;
                case 2:
                    $sid = ($sid - 1) / 2;
                    break;
                case 3:
                    $sid = $sid / 4;
                    break;
                case 4:
                    $sid = ($sid - 1) / 4;
                    break;
                case 5:
                    $sid = ($sid - 2) / 4;
                    break;
                case 6:
                    if (!(($sid - 3) % 4)) {
                        $sid = ($sid - 3) / 4;
                    } else {
                        $sid = null;
                    }
                    break;
            }
            if (!is_null($sid)) {
                $uid = $this->tree->findUser($sid);
                if (!is_null($uid)) {
                    $this->tree = new Sheet($next, $uid);
                    $this->tree->insert();
                }
            }
        }
    }

    /**
     * @param $uid
     * @param $pid
     * @param $name
     * @param $level
     *
     * @param $sid
     *
     * @internal param $id
     * @internal param $self
     */
    private function addNotificationEndBye($uid, $pid, $name, $level, $sid){

        $users = $this->user->findChildRef($pid);
        $count = $this->tree->findUsersCount($users) - 1;

        foreach([$uid, $pid] as $id) {
            $user = $this->user->find($id);

            if($user) {
                $user->notifications()->save(
                    new Notification([
                        'name' => $level . '-й этап',
                        'text' => 'Пользаватель ' . $name . ' попал в ' . $level . '-й этап'
                    ])
                );
            }
        }

        if(! ($level%3)) {
            if (!(($count - $this->start) % $this->interval)) {
                /**
                 * TODO Выплота пользавателю
                 */
                $user = $this->user->find($uid);

                if ($user) {
                    $user->notifications()->save(
                        new Notification([
                            'name' => 'Поступление',
                            'text' => 'Пользаватель ' . $name . ' принес вам 1000Р ' . $count
                        ])
                    );
                }
            }
        } else {
            if($count >= $this->number) {
                $currentUid = $uid;
                if(! (($sid - 3) % 4) && $sid != 3) {
                    $uid = $this->tree->findUser($sid-2);
                    $sid = ($sid - 3) / 4;
                    if(is_null($uid)) {
                        $uid = $this->tree->findUser($sid);
                        $user = $this->user->find($uid);
                        if ($user) {
                            $user->notifications()->save(
                                new Notification([
                                    'name' => 'Поступление',
                                    'text' => 'Пользаватель ' . $name . ' принес вам 1000Р ' . $count
                                ])
                            );
                        }
                    } else {
                        $this->tree = new Sheet($level, $currentUid);
                        $this->tree->insert();
                    }
                } elseif(! (($sid - 1) % 4)) {
                    $uid = $this->tree->findUser($sid+2);
                    $sid = ($sid - 1) / 4;
                    if(is_null($uid)) {
                        $uid = $this->tree->findUser($sid);
                        $user = $this->user->find($uid);
                        if ($user) {
                            $user->notifications()->save(
                                new Notification([
                                    'name' => 'Поступление',
                                    'text' => 'Пользаватель ' . $name . ' принес вам 1000Р ' . $count
                                ])
                            );
                        }
                    } else {
                        $this->tree = new Sheet($level, $currentUid);
                        $this->tree->insert();
                    }
                } elseif(! (($sid - 2) % 4)) {
                    $sid = ($sid - 2) / 4;
                    $uid = $this->tree->findUser($sid);
                    if(! is_null($uid)) {
                        $user = $this->user->find($uid);
                        if ($user) {
                            $user->notifications()->save(
                                new Notification([
                                    'name' => 'Поступление',
                                    'text' => 'Пользаватель ' . $name . ' принес вам 1000Р ' . $count
                                ])
                            );
                        }
                    }
                } elseif(! ($sid % 4)) {
                    $sid = $sid / 4;
                    $uid = $this->tree->findUser($sid);
                    if(! is_null($uid)) {
                        $user = $this->user->find($uid);
                        if ($user) {
                            $user->notifications()->save(
                                new Notification([
                                    'name' => 'Поступление',
                                    'text' => 'Пользаватель ' . $name . ' принес вам 1000Р ' . $count
                                ])
                            );
                        }
                    }
                }
            }
        }
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('tree.one.bye', '\Notprometey\Mposuccess\Event\TreeEventHandler@onTreeOneBye');
        $events->listen('tree.two.bye', '\Notprometey\Mposuccess\Event\TreeEventHandler@onTreeTwoBye');
        $events->listen('tree.three.bye', '\Notprometey\Mposuccess\Event\TreeEventHandler@onTreeThreeBye');

        $events->listen('tree.four.bye', '\Notprometey\Mposuccess\Event\TreeEventHandler@onTreeFourBye');
        $events->listen('tree.five.bye', '\Notprometey\Mposuccess\Event\TreeEventHandler@onTreeFiveBye');
        $events->listen('tree.six.bye', '\Notprometey\Mposuccess\Event\TreeEventHandler@onTreeSixBye');
    }

}