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

    /**
     * Create/register user
     *
     * @return string
     */
    public function createUser($data)
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
            'refer'      => $data['refer'] ? $data['refer'] : $this->find(1)->sid
        ]);

        $user->update([
            'sid' => str_pad($user->country, 4, "0", STR_PAD_LEFT) . date('Y') . (100000 + $user->id)
        ]);

        $badUserRole = RoleCustom::where('slug', 'bad.user')->firstOrFail();
        $user->attachRole($badUserRole);

        return $user;
    }
}