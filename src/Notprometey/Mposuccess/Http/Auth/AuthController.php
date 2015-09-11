<?php

namespace Notprometey\Mposuccess\Http\Auth;

use Illuminate\Support\Facades\Lang;
use Notprometey\Mposuccess\Models\User;
use Notprometey\Mposuccess\Repositories\User\UserRepository;
use Notprometey\Mposuccess\Repositories\Country\CountryRepository;
use Notprometey\Mposuccess\Repositories\Program\ProgramRepository;
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
        return Validator::make($data, [
            'name'                  => 'required|min:2|max:32',
            'surname'               => 'required|min:2|max:32',
            'patronymic'            => 'required|min:2|max:32',
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
        return $this->userRepository->createUser($data);
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
        return User::select('sid', DB::raw('CONCAT(surname, " ", name, "(", email, ")") AS name'))
            ->whereRaw('email like ? or sid like ?', [$q,$q])->take(10)->get();
    }
}
