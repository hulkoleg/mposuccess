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
use Notprometey\Mposuccess\Repositories\User\UserRepository;
use Notprometey\Mposuccess\Repositories\Country\CountryRepository;
use Notprometey\Mposuccess\Repositories\Program\ProgramRepository;
use Validator;
use Hash;


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

        $this->request = $request;
        if ( ! is_null($this->layout))
        {
            $this->layout = view($this->layout);
            if($this->user->is('bad.user')){
                $this->layout->slidebar = view('mposuccess::profile.layout.user.slidebar');
                $this->layout->r_slidebar = null;
            }else{
                $this->layout->slidebar = view('mposuccess::profile.layout.slidebar');
                $this->layout->r_slidebar = view('mposuccess::profile.layout.r_slidebar');
            }
        }
    }

    /**
     * Данные пользавателя
     *
     * @return Response
     */
    public function personal(CountryRepository $country, ProgramRepository $program, UserRepository $user)
    {
        $data = [
            'user'          => $this->user,
            'countries'     => $country->all(),
            'programs'      => $program->all(),
            'refer'         => $user->getRefer($this->user->refer)
        ];

        $this->layout->content = view("mposuccess::profile.personal", $data);
        $this->layout->title = trans('mposuccess::profile.personal');
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
     * Закрытые новости профиля
     *
     * @return Response
     */
    public function news()
    {
        $this->layout->content = view("mposuccess::profile.news");
        $this->layout->title = trans('mposuccess::profile.news');
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