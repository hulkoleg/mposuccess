<?php

namespace Notprometey\Mposuccess\Models;

use Bican\Roles\Models\Permission;

class PermissionCustom extends Permission
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * Not working 'model' field in 'edit_fields', use field test for setting data
     *
     * @var string
     */
    public function setTestAttribute($value)
    {
        $this->attributes['model'] = $value;
    }
}
