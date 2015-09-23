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
use Notprometey\Mposuccess\Repositories\Tree\TreeRepository;
use Notprometey\Mposuccess\Repositories\User\UserRepository;
use Auth;
use Response;

/**
 * Handles all requests related to managing the data models
 */
class ProfileController extends UserController {

    protected $id = null;

    protected $user = null;

    /**
     * @param \Illuminate\Http\Request              $request
     * @param \Illuminate\Session\SessionManager    $session
     */
    public function __construct(Request $request, Session $session, UserRepository $user)
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
        \Assets::add('tree.css');
        \Assets::add('tree.js');

        TreeRepository::setTable('Notprometey\Mposuccess\Models\Tree');
        $tree = app('Notprometey\Mposuccess\Repositories\Tree\TreeRepository');

        $sheet = new Sheet($id, $this->id, $tree->findBy('user_id', $this->id)->id);

        $this->layout->content = view("mposuccess::profile.structures", [
            'sheet' => $sheet
        ]);
        $this->layout->title = trans('mposuccess::profile.structures.' . $id) . ' ' . trans('mposuccess::profile.structures.one');
        return $this->layout;
    }

    public function build(Request $request, $sid, $uid = null){

        if(!Auth::check() && !$request->ajax()) {
            return Response::json(array('massage' => ''), 401);
        }

        if(is_null($uid)){
            TreeRepository::setTable('Notprometey\Mposuccess\Models\Tree');
            $tree = app('Notprometey\Mposuccess\Repositories\Tree\TreeRepository');
            $uid = $tree->findUser($sid);
        }

        $sheet = new Sheet(1, $uid, $sid);

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
}