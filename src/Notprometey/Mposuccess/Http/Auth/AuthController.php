<?php

namespace Notprometey\Mposuccess\Http\Auth;

use Illuminate\Support\Facades\Lang;
use Notprometey\Mposuccess\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'                  => 'required|min:2|max:255',
            'surname'               => 'required|max:255',
            'patronymic'            => 'required|max:255',
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'same:password',
            'birthday'              => 'required|date',
        ], [
            'name.required'         => 'Введите ваше имя',
            'name.min'              => 'В имени должно быть минимум 2 символа',
            'surname.required'      => 'Введите вашу фамилию',
            'patronymic.required'   => 'Введите ваше отчество',
            'email.required'        => 'Введите ваш e-mail',
            'password.required'     => 'Введите ваш пароль',
            'password.confirmed'    => 'Пароль не совпадает',
            'password.min'          => 'Пароль должен содержать минимум 6 символов',
            'birthday.required'     => 'Введите вашу дату рождения',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'       => $data['name'],
            'surname'    => $data['surname'],
            'patronymic' => $data['patronymic'],
            'email'      => $data['email'],
            /*
             * remove hash password (replace in set attribute model User)
             */
            'password'   => $data['password'],
            'birthday'   => $data['birthday'],
            'programm'   => $data['programm'],
            'country'    => $data['country']
        ]);
    }

    public function getLogin()
    {
        return view('mposuccess::auth.login');
    }

    public function getRegister()
    {
        return view('mposuccess::auth.register');
    }
}
