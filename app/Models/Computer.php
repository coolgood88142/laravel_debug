<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Computer extends Model
{
    protected $collection = 'computer';
    public $timestamps = false;

}
