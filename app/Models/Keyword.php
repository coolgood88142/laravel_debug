<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Keyword extends Model
{
    protected $collection = 'keyword';
    public $timestamps = false;

}
