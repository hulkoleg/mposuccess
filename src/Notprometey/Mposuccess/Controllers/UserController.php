<?php
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 21.08.2015
 * Time: 21:11
 */
namespace Notprometey\Mposuccess\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Session\SessionManager as Session;
use Notprometey\Mposuccess\Models\News;
use Notprometey\Mposuccess\Repositories\User\Criteria\Current;
use Notprometey\Mposuccess\Repositories\User\UserRepository;
use Notprometey\Mposuccess\Repositories\Country\CountryRepository;
use Notprometey\Mposuccess\Repositories\Program\ProgramRepository;
use Notprometey\Mposuccess\Repositories\News\NewsRepository;
use Validator;
use Hash;

use Illuminate\Pagination\Paginator;


/**
 * Handles all requests related to managing the data models
 */
class UserController extends Controller {
    /**
     * user id
     */
    protected $id;
    /**
     * user all unfo
     */
    protected $user;
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
    protected $layout = "mposuccess::layouts.panel.main";

    /**
     * @param \Illuminate\Http\Request              $request
     * @param \Illuminate\Session\SessionManager    $session
     */
    public function __construct(Request $request, Session $session, UserRepository $user)
    {

        $this->id = Auth::user()->id;

        $this->user = $user->find($this->id);

        if ($this->user->refer == 0) {
            $this->user->refer = 1;
        }

        $this->request = $request;
        if ( ! is_null($this->layout))
        {
            $this->layout = view($this->layout);
            if($this->user->is('bad.user')){
                $this->layout->slidebar = view('mposuccess::profile.layout.user.slidebar');
                $this->layout->r_slidebar = null;
            }elseif($this->user->is('user')){
                $this->layout->slidebar = view('mposuccess::profile.layout.slidebar');
                $this->layout->r_slidebar = view('mposuccess::profile.layout.r_slidebar');
            }else{
                $this->layout->slidebar = view('mposuccess::admin.layout.slidebar');
                $this->layout->r_slidebar = view('mposuccess::profile.layout.r_slidebar');
            }
        }
    }

    /**
     * Данные пользавателя
     *
     * @return Response
     */
    public function personal(CountryRepository $country, ProgramRepository $program, UserRepository $userRepository)
    {
        $data = [
            'user'          => $this->user,
            'countries'     => $country->all(),
            'programs'      => $program->all(),
        ];

        if ($this->id != 1) {
            $data['refer'] = $userRepository->getRefer($this->user->refer);
        }

        $this->layout->content = view("mposuccess::profile.personal", $data);
        $this->layout->title = trans('mposuccess::profile.myProfile');
        return $this->layout;
    }

    /**
     * Данные другого пользавателя
     *
     * @return Response
     */
    public function user($id, CountryRepository $countryRepository, ProgramRepository $programRepository, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);
        if (!$user) {
            abort(404);
        }

        if ($user->refer == 0) {
            $user->refer = 1;
        }

        if ($user->birthday == "0000-00-00") {
            $user->birthday = null;
        } else {
            $user->birthday = date_format(date_create($user->birthday), 'd M Y');
        }

        $data = [
            'user'          => $user,
            'country'       => $countryRepository->findby('code', $user->country),
            'program'       => $programRepository->find($user->program)
        ];

        if ($this->id != 1) {
            $data['refer'] =  app('Notprometey\Mposuccess\Repositories\User\UserRepository')->getRefer();
        }

        $this->layout->content = view("mposuccess::profile.user", $data);
        $this->layout->title = trans('mposuccess::profile.user') . ' ' . $user->name;
        return $this->layout;
    }

    /**
     * Изменение личных данных
     *
     * @return Response
     */
    public function changeData(UserRepository $user)
    {
        $v = Validator::make($this->request->all(), [
            'name'       => 'required|min:2|max:32',
            'surname'    => 'required|min:2|max:32',
            'patronymic' => 'required|min:2|max:32',
            'birthday'   => 'required|date',
            'email'      => 'required|email|max:255|unique:users',
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput()->with('tab', 1);
        }

        $user->update([
            'name'       => $this->request->input('name'),
            'surname'    => $this->request->input('surname'),
            'patronymic' => $this->request->input('patronymic'),
            'birthday'   => date_format(date_create($this->request->input('birthday')), 'Y-m-d'),
            'email'      => $this->request->input('email')
        ], $this->user->id);

        return redirect('profile');
    }

    /**
     * Измение аватара
     *
     * @return Response
     */
    public function changeAvatar(UserRepository $user)
    {
        $user->changeAvatar($this->request, $this->user);

        return redirect()->back();
    }

    /**
     * Удаление аватара
     *
     * @return Response
     */
    public function removeAvatar(UserRepository $user)
    {
        $user->removeAvatar($this->user->id, $this->user->url_avatar);

        return redirect()->back();
    }

    /**
     * Изменение пароля
     *
     * @return Response
     */
    public function changePassword(UserRepository $user)
    {
        $v = Validator::make($this->request->all(), [
            'password'              => 'required|confirmed|min:8',
            'password_confirmation' => 'same:password',
        ]);

        $v->after(function($v) {
            if (!Hash::check($this->request->input('current'), $this->user->password)) {
                $v->errors()->add('current', 'Неправильный пароль!');
            }
        });

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput()->with('tab', 3);
        }

        $user->update([
            'password' => bcrypt($this->request->input('password'))
        ], $this->user->id);

        return redirect('profile');
    }

    /**
     * Личные данные
     *
     * @return Response
     */
    public function dashboard()
    {
        $this->layout->content = view("mposuccess::profile.dashboard");
        $this->layout->title = trans('mposuccess::profile.personal');
        return $this->layout;
    }

    /**
     * Закрытые новости профиля
     *
     * @return Response
     */
    public function news(NewsRepository $newsRepository, Request $request)
    {
        //$news = News::where('type', '=', 1)->paginate(2);
        //$newsRepository->findBy('type', config('mposuccess.news_type_private'))->get();
        $perPage = $this->request->input('perPage') ? $this->request->input('perPage') : 3;
        $news = \DB::table('news')->paginate($perPage);
        //$pagi = new Paginator($news, count($news), 2);


        $data = [
            //'news'  => News::all(),
            //'pagi'  => $pagi,
            'news' => $news
        ];

        $this->layout->content = view("mposuccess::profile.news", $data);
        $this->layout->title = trans('mposuccess::profile.news');
        return $this->layout;
    }

    /**
     * Просмотр новости (поста)
     *
     * @return Response
     */
    public function post($id, NewsRepository $newsRepository)
    {
        $data = [
            'news' => $newsRepository->find($id)
        ];

        $this->layout->content = view("mposuccess::profile.post", $data);
        $this->layout->title = trans('mposuccess::profile.post');
        return $this->layout;
    }

    /**
     * пополнения счета
     *
     * @return Response
     */
    public function refill()
    {
        $this->layout->content = view("mposuccess::profile.score.refill");
        $this->layout->title = trans('mposuccess::profile.score.refill');
        return $this->layout;
    }
    /**
     * Каталог товаров для покупки
     *
     * @return Response
     */
    public function catalog()
    {
        $this->layout->content = view("mposuccess::profile.catalog");
        $this->layout->title = trans('mposuccess::profile.catalog');
        return $this->layout;
    }
}