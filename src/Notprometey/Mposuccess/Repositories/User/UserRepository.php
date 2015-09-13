<?php namespace Notprometey\Mposuccess\Repositories\User;
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 22.08.2015
 * Time: 11:08
 */

use Notprometey\Mposuccess\Repositories\Repository;
use Notprometey\Mposuccess\Models\RoleCustom;
use Notprometey\Mposuccess\Models\User;

class UserRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {

        return 'Notprometey\Mposuccess\Models\User';
    }

    /**
     * Change/add (upload) avatar for user
     *
     * @return boolean
     */
    public function changeAvatar($request, $user)
    {
        if ($request->hasFile('photo'))
        {
            $destinationPath = "/images/users/";
            $fileName = $user->sid . '.' . $request->file('photo')->getClientOriginalExtension();

            if ($user->url_avatar) {
                if (file_exists(public_path() . $user->url_avatar)) {
                    unlink(public_path() . $user->url_avatar);
                }
            }

            $request->file('photo')->move(public_path() . $destinationPath, $fileName);

            $this->update([
                'url_avatar' => $destinationPath . $fileName
            ], $user->id);

            return true;
        }
        return false;
    }

    /**
     * Remove avatar for user
     *
     * @return boolean
     */
    public function removeAvatar($id, $url_avatar)
    {
        if ($url_avatar) {
            if (file_exists(public_path() . $url_avatar)) {
                unlink(public_path() . $url_avatar);
            }

            $this->update([
                'url_avatar' => ''
            ], $id);
        }

        return true;
    }

    /**
     * Get refer user
     *
     * @return string
     */
    public function getRefer($refer_sid)
    {
        $refer = $this->findBy('sid', $refer_sid);

        return trim($refer->surname . $refer->name . "(" . $refer->email . ")") ;
    }
}