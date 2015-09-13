<?php

namespace Notprometey\Mposuccess\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Bican\Roles\Models\Role;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, HasRoleAndPermissionContract
{
    use Authenticatable, CanResetPassword, HasRoleAndPermission;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','sid', 'name', 'surname', 'patronymic', 'email', 'password', 'birthday', 'program', 'country', 'url_avatar', 'refer'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['remember_token'];

    /**
     * Accessor for transform password to hash when setting him.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Accessor for transform password to hash when setting him.
     */
    public function setSidAttribute($value)
    {
        if (!$value) {
            $year = date('Y');
            $codeCountry = str_pad($this->attributes['country'], 4, "0", STR_PAD_LEFT);

            $this->attributes['sid'] = $codeCountry . $year . (100000 + $this->attributes['id']);
        }
    }

    /**
     * Each user can have many roles.
     */
    public function roles()
    {
        return $this->belongsToMany('Bican\Roles\Models\Role', 'role_user');
    }

    /**
     * Each user can have many permissions.
     */
    public function permissions()
    {
        return $this->belongsToMany('Bican\Roles\Models\Permission', 'permission_user');
    }
}
