<?php

namespace Notprometey\Mposuccess\Models;

use Illuminate\Database\Eloquent\Model;

class TreeSetting extends Model
{
    protected $table = 'tree_settings';
    public $timestamps = false;
    protected $fillable = ['param', 'value', 'level'];
}
