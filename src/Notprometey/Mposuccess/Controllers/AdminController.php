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
use Notprometey\Mposuccess\Repositories\User\UserRepository;
use Notprometey\Mposuccess\Repositories\News\NewsRepository;
use Auth;

/**
 * Handles all requests related to managing the data models
 */
class AdminController extends ProfileController {

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
        if ( ! is_null($this->layout))
        {
            $this->layout = view($this->layout);
            $this->layout->slidebar = view('mposuccess::admin.layout.slidebar');
            $this->layout->r_slidebar = null;
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
     * Управление статьями
     *
     * @return Response
     */
    public function article()
    {
        $this->layout->content = view("mposuccess::admin.article");
        $this->layout->title = trans('mposuccess::admin.article');
        return $this->layout;
    }
    /**
     * Управление новостями
     *
     * @return Response
     */
    public function news(NewsRepository $newsRepository)
    {
        $this->layout->content = view("mposuccess::admin.news");
        $this->layout->title = trans('mposuccess::admin.news');
        return $this->layout;
    }
    /**
     * Управление оплатами пользователей
     *
     * @return Response
     */
    public function payments()
    {
        $this->layout->content = view("mposuccess::admin.payments");
        $this->layout->title = trans('mposuccess::admin.payments');
        return $this->layout;
    }

    /**
     * Управление бухгалтерскими отчётами
     *
     * @return Response
     */
    public function reports()
    {
        $this->layout->content = view("mposuccess::admin.reports");
        $this->layout->title = trans('mposuccess::admin.reports');
        return $this->layout;
    }

    /**
     * Управление ролями пользователей
     *
     * @return Response
     */
    public function roles()
    {
        $this->layout->content = view("mposuccess::admin.roles");
        $this->layout->title = trans('mposuccess::admin.roles');
        return $this->layout;
    }
    /**
     * Управление пользователями
     *
     * @return Response
     */
    public function users()
    {
        $this->layout->content = view("mposuccess::admin.users");
        $this->layout->title = trans('mposuccess::admin.user');
        return $this->layout;
    }
}