<?php

namespace Notprometey\Mposuccess\Http\Auth;

use Illuminate\Support\Facades\Lang;
use Notprometey\Mposuccess\Models\User;
use Notprometey\Mposuccess\Repositories\User\UserRepository;
use Notprometey\Mposuccess\Repositories\Country\CountryRepository;
use Notprometey\Mposuccess\Repositories\Program\ProgramRepository;
use Notprometey\Mposuccess\Models\RoleCustom;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use DB;

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
     * Redirect path after auth
     */
    protected $redirectPath = 'panel';

    /**
     * Todo пока в конструктор запихнул userRepository
     */
    protected $userRepository;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $repository)
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->userRepository = $repository;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        Validator::extend('cyrillic', function ($attribute, $value, $parameters) {
            return preg_match("/^[^-]{1}[А-Яа-яЁё-]+$/u", $value);
        });
        $data['name'] = trim($data['name']);
        $data['surname'] = trim($data['surname']);
        $data['patronymic'] = trim($data['patronymic']);
        $data['email'] = trim($data['email']);

        return Validator::make($data, [
            'name'                  => 'required|min:2|max:32|cyrillic',
            'surname'               => 'required|min:2|max:32|cyrillic',
            'patronymic'            => 'required|min:2|max:32|cyrillic',
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|confirmed|min:8',
            'password_confirmation' => 'same:password',
            'birthday'              => 'required|date',
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
        /**
         * Todo не получилось заюзать репу
         */
        $user = User::create([
            'name'       => $data['name'],
            'surname'    => $data['surname'],
            'patronymic' => $data['patronymic'],
            'email'      => $data['email'],
            /*
             * remove hash password (replace in set attribute model User)
             */
            'password'   => $data['password'],
            'birthday'   => date_format(date_create($data['birthday']), 'Y-m-d'),
            'program'    => $data['program'],
            'country'    => $data['country'],
            'refer'      => $data['refer'] ? $data['refer'] : User::find(1)->sid
        ]);

        $id = $user->id;
        $newUser = User::find($id);
        $newUser->sid = '';
        $newUser->save();

        $badUserRole = RoleCustom::where('slug', 'bad.user')->firstOrFail();
        $user->attachRole($badUserRole);

        return $user;
    }

    public function getLogin()
    {
        return view('mposuccess::auth.login');
    }

    public function getRegister(ProgramRepository $program, CountryRepository $country)
    {
        $data = [
            'countries' => $country->all(),
            'programs'  => $program->all(),
        ];

        return view('mposuccess::auth.register', $data);
    }

    /*
     * Get list users (refers) by email or sid
     */
    public function getRefers(Request $request)
    {
        $q = '%' . $request->query('q') . '%';
        return User::select('id', DB::raw('CONCAT(surname, " ", name, "(", email, ")") AS name'))
            ->whereRaw('email like ? or sid like ?', [$q,$q])->take(10)->get();
    }
}
