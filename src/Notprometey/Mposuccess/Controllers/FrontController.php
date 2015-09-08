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
use Notprometey\Mposuccess\Repositories\User\UserRepository;
/**
 * Handles all requests related to managing the data models
 */
class FrontController extends Controller {
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * @var \Illuminate\Session\SessionManager
     */
    protected $session;
    /**
     * @var string
     */
    protected $layout = "mposuccess::layouts.front.main";

    /**
     * @param \Illuminate\Http\Request              $request
     * @param \Illuminate\Session\SessionManager    $session
     */
    public function __construct(Request $request, Session $session)
    {
        $this->request = $request;
        if ( ! is_null($this->layout))
        {
            $this->layout = view($this->layout);
            $this->layout->page = false;
            $this->layout->dashboard = false;
        }
        $this->layout->slider = null;
    }

    /**
     * The main view for any of the data models
     *
     * @return Response
     */
    public function index()
    {
        $this->layout->content = view("mposuccess::front.index");
        $this->layout->slider = view("mposuccess::layouts.front.slider");
        $this->layout->title = trans('mposuccess::front.home');
        return $this->layout;
    }

    public function defense()
    {
        $this->layout->content = view("mposuccess::front.success.defense");
        $this->layout->title = trans('mposuccess::front.success.defense');
        return $this->layout;
    }

    public function news()
    {
        $this->layout->content = view("mposuccess::front.news");
        $this->layout->title = trans('mposuccess::front.news');
        return $this->layout;
    }

    public function article()
    {
        $this->layout->content = view("mposuccess::front.article");
        $this->layout->title = trans('mposuccess::front.article');
        return $this->layout;
    }

    public function about()
    {
        $this->layout->content = view("mposuccess::front.about.about");
        $this->layout->title = trans('mposuccess::front.about.title');
        return $this->layout;
    }

    public function contacts()
    {
        $this->layout->content = view("mposuccess::front.about.contacts");
        $this->layout->title = trans('mposuccess::front.about.contacts');
        return $this->layout;
    }

    public function rights()
    {
        $this->layout->content = view("mposuccess::front.about.rights");
        $this->layout->title = trans('mposuccess::front.about.rights');
        return $this->layout;
    }

    public function charter()
    {
        $this->layout->content = view("mposuccess::front.about.docs.charter");
        $this->layout->title = trans('mposuccess::front.about.docs.charter');
        return $this->layout;
    }

    public function regdocs()
    {
        $this->layout->content = view("mposuccess::front.about.docs.regdocs");
        $this->layout->title = trans('mposuccess::front.about.docs.regdocs');
        return $this->layout;
    }
}