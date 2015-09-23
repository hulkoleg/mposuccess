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

class TreeEventHandler implements ShouldQueue {
    use InteractsWithQueue;

    public function onTreeBye($event)
    {
        return [
            'type' => 'success',
            'name' => 'Выплаты совершены',
            'message' => ''
        ];
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('tree.bye', '\Notprometey\Mposuccess\Event\TreeEventHandler@onTreeBye');
    }

}