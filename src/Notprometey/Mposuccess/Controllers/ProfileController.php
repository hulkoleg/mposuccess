<?php
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 21.08.2015
 * Time: 21:11
 */
namespace Notprometey\Mposuccess\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Session\SessionManager as Session;
use Illuminate\Support\Facades\View;
use Illuminate\View\ViewServiceProvider;
use Notprometey\Mposuccess\BinaryTree\Sheet;
use Notprometey\Mposuccess\Repositories\Notification\NotificationRepository;
use Notprometey\Mposuccess\Repositories\Tree\TreeRepository;
use Notprometey\Mposuccess\Repositories\User\UserRepository;
use Auth;
use Assets;
use Response;

/**
 * Handles all requests related to managing the data models
 */
class ProfileController extends UserController {

    protected $id = null;

    protected $user = null;

    /**
     * @param \Illuminate\Http\Request           $request
     * @param \Illuminate\Session\SessionManager $session
     * @param UserRepository                     $user
     * @param NotificationRepository             $notification
     */
    public function __construct(Request $request, Session $session, UserRepository $user, NotificationRepository $notification)
    {

        $this->id = Auth::user()->id;

        $this->user = $user->find($this->id);

        $this->request = $request;
        if (!is_null($this->layout)) {
            $this->layout = view($this->layout);
            if ($this->user->is('user')) {
                $this->layout->slidebar = view('mposuccess::profile.layout.slidebar');
                $this->layout->r_slidebar = view('mposuccess::profile.layout.r_slidebar');
            } else {
                $this->layout->slidebar = view('mposuccess::admin.layout.slidebar');
                $this->layout->r_slidebar = view('mposuccess::profile.layout.r_slidebar');
            }

            $this->layout->notifications = $notification->findAllBy('sid', $this->id);
            $this->layout->notification_count = $notification->allCount($this->id);
            $this->layout->notification_new = $notification->newCount($this->id);
        }
    }

    /**
     * The main view for any of the data models
     *
     * @return Response
     */
    public function index()
    {
    }

    /**
     * вывод средств
     *
     * @return Response
     */
    public function withdrawal()
    {
        $this->layout->content = view("mposuccess::profile.score.withdrawal");
        $this->layout->title = trans('mposuccess::profile.score.withdrawal');
        return $this->layout;
    }
    /**
     * покупки пользавателя
     *
     * @return Response
     */
    public function purchases()
    {
        $this->layout->content = view("mposuccess::profile.score.purchases");
        $this->layout->title = trans('mposuccess::profile.score.purchases');
        return $this->layout;
    }
    /**
     * Личные места пользавателя
     *
     * @return Response
     */
    public function places()
    {
        $this->layout->content = view("mposuccess::profile.score.places");
        $this->layout->title = trans('mposuccess::profile.score.places');
        return $this->layout;
    }

    /**
     * Структуры пользавателей
     *
     * @param                $id
     * @param TreeRepository $tree
     *
     * @return Response
     */
    public function structures($id)
    {
        Assets::add('tree.css');
        Assets::add('tree.js');

        TreeRepository::setTable('Notprometey\Mposuccess\Models\Tree' . $id);
        $tree = app('Notprometey\Mposuccess\Repositories\Tree\TreeRepository');

        $user = $tree->findBy('user_id', $this->id);
        if(isset($user->id)){
            $sheet = new Sheet($id, $this->id, $user->id);
        }
        $this->layout->content = view("mposuccess::profile.structures", [
            'sheet' => isset($sheet)?$sheet:'Этап пока не доступен.'
        ]);
        $this->layout->title = trans('mposuccess::profile.structures.' . $id) . ' ' . trans('mposuccess::profile.structures.one');
        return $this->layout;
    }

    public function build(Request $request, $level, $sid){

        if(!Auth::check() && !$request->ajax()) {
            return Response::json(array('massage' => ''), 401);
        }

        if(0 == $sid){
            return array(
                'message' => [
                    'type' => 'warning',
                    'name' => 'Это место является верхним',
                    'message' => ''
                ]
            );
        }

        TreeRepository::setTable('Notprometey\Mposuccess\Models\Tree' . $level);
        $tree = app('Notprometey\Mposuccess\Repositories\Tree\TreeRepository');
        $uid = $tree->findUser($sid);

        $user = app('Notprometey\Mposuccess\Repositories\User\UserRepository');

        if(!($this->user->refer == $uid || $this->id == $uid || $user->findChild($uid, $this->id))){
            return array(
                'message' => [
                    'type' => 'warning',
                    'name' => 'Недостатосно привелегий',
                    'message' => 'Пользаватель не является вашим рефералом или лично приглашонным.'
                ]
            );
        }

        $sheet = new Sheet($level, $uid, $sid);

        return Response::json($sheet->toArray());
    }
    /**
     * Дерево приглашенных
     *
     * @return Response
     */
    public function tree()
    {
        $this->layout->content = view("mposuccess::profile.tree");
        $this->layout->title = trans('mposuccess::profile.tree');
        return $this->layout;
    }


    public function notification(Request $request, $count){

        if(!Auth::check() && !$request->ajax()) {
            return Response::json(array('massage' => ''), 401);
        }

        $notifications = app('Notprometey\Mposuccess\Repositories\Notification\NotificationRepository');
        $currentCount = $notifications->newCount($this->id);
        $data = array();
        if($currentCount > $count){
            $notifications = $notifications->newNotification($this->id, $count, $currentCount - $count);
            foreach($notifications as $notification){
                array_push($data, array(
                    'type' => 'info',
                    'name' => $notification->name,
                    'message' => $notification->text
                ));
            }
            array_push($data, array(
                'type' => 'notification_count',
                'count' => $currentCount
            ));
        }


        return Response::json($data);
    }
}