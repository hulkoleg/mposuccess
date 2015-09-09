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
use Notprometey\Mposuccess\Models\Country;
use Notprometey\Mposuccess\Models\Program;
use Notprometey\Mposuccess\Repositories\User\UserRepository;
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
    public function personal()
    {
        $data = [
            'user'          => $this->user,
            'countries'     => Country::all(),
            'programs'      => Program::all(),
            'refer'         => $this->user->getRefer()
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
    public function changeData()
    {
        $v = Validator::make($this->request->all(), [
            'name'                  => 'required|min:2|max:255',
            'surname'               => 'required|max:255',
            'patronymic'            => 'required|max:255',
            'birthday'              => 'required|date',
        ], [
            'name.required'         => 'Введите ваше имя',
            'name.min'              => 'В имени должно быть минимум 2 символа',
            'surname.required'      => 'Введите вашу фамилию',
            'patronymic.required'   => 'Введите ваше отчество',
            'birthday.required'     => 'Введите вашу дату рождения',
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput()->with('tab', 1);
        }

        $this->user->surname = $this->request->input('surname');
        $this->user->name = $this->request->input('name');
        $this->user->patronymic = $this->request->input('patronymic');
        $this->user->birthday = date_format(date_create($this->request->input('birthday')), 'Y-m-d');
        $this->user->save();

        return redirect('profile');
    }

    /**
     * Измение аватара
     *
     * @return Response
     */
    public function changeAvatar()
    {
        if ($this->request->hasFile('photo'))
        {
            $destinationPath = "/images/users/";
            $fileName = $this->user->sid . '.' . $this->request->file('photo')->getClientOriginalExtension();

            if ($this->user->url_avatar) {
                unlink(public_path() . $this->user->url_avatar);
            }

            $this->request->file('photo')->move(public_path() . $destinationPath, $fileName);

            $this->user->url_avatar = $destinationPath . $fileName;

            $this->user->save();

            return redirect()->back();
        }
        return redirect()->back();
    }

    /**
     * Удаление аватара
     *
     * @return Response
     */
    public function removeAvatar()
    {
        if ($this->user->url_avatar) {
            if (file_exists(public_path() . $this->user->url_avatar)) {
                unlink(public_path() . $this->user->url_avatar);
            }
        }

        $this->user->url_avatar = "";

        $this->user->save();

        return redirect()->back();
    }

    /**
     * Изменение пароля
     *
     * @return Response
     */
    public function changePassword()
    {
        $v = Validator::make($this->request->all(), [
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'same:password',
        ], [
            'password.required'     => 'Введите ваш пароль',
            'password.confirmed'    => 'Пароль не совпадает',
            'password.min'          => 'Пароль должен содержать минимум 6 символов',
        ]);

        $v->after(function($v) {
            if (!Hash::check($this->request->input('current'), $this->user->password)) {
                $v->errors()->add('current', 'Неправильный пароль!');
            }
        });

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput()->with('tab', 3);
        }

        $this->user->password = $this->request->input('password');
        $this->user->save();
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