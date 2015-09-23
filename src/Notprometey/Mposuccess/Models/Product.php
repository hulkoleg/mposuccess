<?php

namespace Notprometey\Mposuccess\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'des', 'price', 'penny', 'what', 'url'];

    public $timestamps = false;
}
