<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    protected $table = 'computer';
    protected $connection = 'mysql';
    public $timestamps = false;

}
