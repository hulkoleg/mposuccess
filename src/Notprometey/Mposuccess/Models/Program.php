<?php

namespace Notprometey\Mposuccess\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'programs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public $timestamps = false;
}
