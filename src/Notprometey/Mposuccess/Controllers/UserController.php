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
        $regions = [['name' => 'Беларусь', 'code' => '375'], ['name' => 'Россия', 'code' => '789']];
        $instructions = [['name' =>'Покупка продукта(1,2,3 - этапы с последуещим переходом по желанию в 4,5,6)'],
            ['name' =>'Вступление в МПО(4,5,6 - этапы)']];

        $this->layout->content = "111";
        /*view("mposuccess::profile.personal", [
            'user' => $this->user,
            'regions' => $regions,
            'instructions' => $instructions]);*/
        $this->layout->title = trans('mposuccess::profile.personal');
        return $this->layout;
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


    public function changeData(Request $request)
    {
        return redirect('profile')->withInput()->with('tab', 1);
    }

    public function changeAvatar(Request $request)
    {
        if ($request->hasFile('photo'))
        {
            $destinationPath = "/images/users/";
            $fileName = $this->user->name . '.' . $request->file('photo')->getClientOriginalExtension();

            $request->file('photo')->move(public_path() . $destinationPath, $fileName);

            $this->user->url_avatar = $destinationPath . $fileName;

            $this->user->save();

            return $request->server();
        }
        return 0;
    }

    public function changePassword(Request $request)
    {
        $current = $request->input('current');
        $new = $request->input('new');
        $re_type = $request->input('re-type');

        //return $current . ' ' . $new . ' ' . $re_type;

        return redirect('profile')->withInput()->with('tab', 3);
    }
}