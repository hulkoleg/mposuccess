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
use Notprometey\Mposuccess\Repositories\Notification\NotificationRepository;
use Notprometey\Mposuccess\Repositories\User\UserRepository;
use Notprometey\Mposuccess\Repositories\News\NewsRepository;
use Notprometey\Mposuccess\Repositories\Tree\TreeSettingsRepository;
use Auth;

/**
 * Handles all requests related to managing the data models
 */
class AdminController extends ProfileController {

    /**
     * @var null
     */
    protected $id = null;

    /**
     * @var mixed|null
     */
    protected $user = null;

    /**
     * @param \Illuminate\Http\Request              $request
     * @param \Illuminate\Session\SessionManager    $session
     */
    public function __construct(Request $request, Session $session, UserRepository $user,  NotificationRepository $notification)
    {

        $this->id = Auth::user()->id;

        $this->user = $user->find($this->id);

        $this->request = $request;
        if ( ! is_null($this->layout))
        {
            $this->layout = view($this->layout);
            $this->layout->slidebar = view('mposuccess::admin.layout.slidebar');
            $this->layout->r_slidebar = null;

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
        $news = $newsRepository->all();

        $data = [
            'news' => $news
        ];

        $this->layout->content = view("mposuccess::admin.news", $data);
        $this->layout->title = trans('mposuccess::admin.news');
        return $this->layout;
    }
    /**
     * Управление новостями
     *
     * @return Response
     */
    public function addNews()
    {
        $html = '<div class="modal-header">' .
	                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>' .
                    '<h4 class="modal-title">Ajax Content</h4>' .
                '</div>' .
                '<div class="modal-body">' .

                '</div>' .
                '<div class="modal-footer">' .
                    '<button type="button" class="btn default" data-dismiss="modal">Close</button>' .
                    '<button type="button" class="btn blue">Save changes</button>' .
                '</div>';

        return $html;
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

    /**
     * @return View
     */
    public function products()
    {
        $this->layout->content = view("mposuccess::admin.products");
        $this->layout->title = trans('mposuccess::admin.products');
        return $this->layout;
    }


    /**
     * @param TreeSettingsRepository $settings
     * @return View
     */
    public function tree_settings(TreeSettingsRepository $settings)
    {
        $this->layout->content = view("mposuccess::admin.tree_settings", [
            'settings' => $settings->getParamAndGroupLevel()
        ]);
        $this->layout->title = trans('mposuccess::admin.tree_settings');
        return $this->layout;
    }


}