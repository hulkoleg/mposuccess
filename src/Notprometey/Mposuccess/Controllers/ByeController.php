<?php
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 21.08.2015
 * Time: 21:11
 */
namespace Notprometey\Mposuccess\Controllers;

use Auth;
use Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Session\SessionManager as Session;
use Notprometey\Mposuccess\Repositories\User\UserRepository;


/**
 * Handles all requests related to managing the data models
 */
class ByeController extends Controller {
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
     * @param \Illuminate\Http\Request           $request
     * @param \Illuminate\Session\SessionManager $session
     * @param UserRepository                     $user
     */
    public function __construct(Request $request, Session $session, UserRepository $user)
    {
        if(!Auth::check() && !$request->ajax()) {
            return Response::json(array('massage' => ''), 401);
        }
        $this->id = Auth::user()->id;

        $this->user = $user->find($this->id);

        $this->request = $request;
    }

    public function one(){
        return Response::json(array('massage' => 'ок'));
    }
}