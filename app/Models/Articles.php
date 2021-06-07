<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Articles extends Model
{
    protected $collection = 'articles';
    public $timestamps = false;

}
