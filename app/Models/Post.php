<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';

    public static function archives()
    {
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
    }
}
