<?php
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 21.08.2015
 * Time: 21:11
 */
namespace Notprometey\Mposuccess\Controllers;

use Auth;
use Notprometey\Mposuccess\BinaryTree\SheetManager;
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

    protected $data;

    private $one = 1;
    private $two = 2;
    private $three = 3;
    private $four = 4;
    private $five = 4;
    private $six = 4;


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

        $this->data = array(
            0 => [
                'type' => 'success',
                'name' => 'Место успешно создано',
                'message' => ''
            ]
        );
    }

    /**
     * @param $fun
     *
     * @return mixed
     */
    public function action($fun){
        return $this->$fun();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    private function one(){
        return $this->bey($this->one);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    private function two(){
        return $this->bey($this->two);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    private function four(){
        return $this->bey($this->four);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    private function five(){
        return $this->bey($this->five);
    }

    /**
     * @param $level
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function bey($level){
        $tree = new SheetManager($this->id, $level);

        if(!$sheet = $tree->create()) {
            $this->data[0]['type'] = 'error';
            $this->data[0]['name'] = 'Не удалось создать место';
        }

        return Response::json($this->data);
    }
}