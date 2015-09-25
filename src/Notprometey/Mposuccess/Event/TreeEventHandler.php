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
use Notprometey\Mposuccess\Models\Notification;
use Notprometey\Mposuccess\Repositories\Tree\TreeRepository;
use Notprometey\Mposuccess\Repositories\User\UserRepository;

class TreeEventHandler {//implements ShouldQueue {
    //use InteractsWithQueue;

    private $one = 1;

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

    /**
     * @param $event
     */
    public function onTreeOneBye($name, $sid, $pid)
    {
        TreeRepository::setTable('Notprometey\Mposuccess\Models\Tree' . $this->one);
        $this->tree = app('Notprometey\Mposuccess\Repositories\Tree\TreeRepository');
        $this->user = app('Notprometey\Mposuccess\Repositories\User\UserRepository');

        $this->addNotification($sid, $name);
        $this->addNotification($pid, $name);
    }

    /**
     * @param $id
     * @param $name
     */
    private function addNotification($id, $name){
        $users = $this->user->findChildRef($id);
        $count = $this->tree->findUsersCount($users);
        $user = $this->user->find($id);

        if($user) {
            $user->notifications()->save(
                new Notification([
                    'name' => 'Пользаватели',
                    'text' => 'Пользаватель ' . $name . ' попал в первый этап'
                ])
            );
        }

        if (($count - $this->start) % $this->interval) {
            /**
             * TODO Выплота пользавателю
             */
            if($user) {
                $user->notifications()->save(
                    new Notification([
                        'name' => 'Поступление',
                        'text' => 'Пользаватель ' . $name . ' принес вам 1000Р'
                    ])
                );
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
    }

}