<?php

namespace Notprometey\Mposuccess\Models;

use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    protected $table = 'tree';
    public $timestamps = false;
    protected $fillable = array('user_id', 'id');
}
