<?php namespace Notprometey\Mposuccess\Repositories\Menu;
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 22.08.2015
 * Time: 11:08
 */

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Notprometey\Mposuccess\Repositories\Menu\Contract\MenuEloquent;
use Notprometey\Mposuccess\Repositories\RepositoryInterface;
use Notprometey\Mposuccess\Repositories\Repository;

class MenuRepository extends MenuEloquent {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Notprometey\Mposuccess\Models\Menu';
    }
    private $item = null;
    public function with($name = '') {
        $this->applyCriteria();
        $menu =  $this->model->with($name)->get()->toArray();
        $this->item = &$menu;

        $tpm = array_search(Request::path(), array_column($menu, 'route'));
        if($tpm === false){
            array_walk($menu, [$this, 'item']);
        }
        else{
            $menu[$tpm]['active'] = 'active';
        }


        return $menu;
    }

    private function item(&$item){
        $tpm = array_search(Request::path(), array_column($item['sub'], 'route'));
        if($tpm !== false) {
            $item['active'] = 'active open';
            $item['open'] = 'open';
            $item['display'] = 'block';
            $item['sub'][$tpm]['active'] = 'active';
        }
    }

}