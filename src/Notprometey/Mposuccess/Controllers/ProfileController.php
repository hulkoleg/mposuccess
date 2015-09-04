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
use Auth;
use Notprometey\Mposuccess\Models\User;
/**
 * Handles all requests related to managing the data models
 */
class ProfileController extends Controller {
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

    protected $id = null;

    protected $user = null;

    /**
     * @param \Illuminate\Http\Request              $request
     * @param \Illuminate\Session\SessionManager    $session
     */
    public function __construct(Request $request, Session $session)
    {
        $this->id = Auth::user()->id;

        $this->user = User::find($this->id);

        $this->request = $request;
        if ( ! is_null($this->layout))
        {
            $this->layout = view($this->layout);
            $this->layout->slidebar = view('mposuccess::profile.layout.slidebar');
            $this->layout->r_slidebar = view('mposuccess::profile.layout.r_slidebar');
        }
    }

    /**
     * The main view for any of the data models
     *
     * @return Response
     */
    public function index()
    {
        $regions = [['name' => 'Беларусь', 'code' => '375'], ['name' => 'Россия', 'code' => '789']];
        $instructions = [['name' =>'Покупка продукта(1,2,3 - этапы с последуещим переходом по желанию в 4,5,6)'],
                            ['name' =>'Вступление в МПО(4,5,6 - этапы)']];
        $this->layout->content = view("mposuccess::profile.index", [
            'user' => $this->user,
            'regions' => $regions,
            'instructions' => $instructions]);
        $this->layout->title = trans('mposuccess::profile.index');
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