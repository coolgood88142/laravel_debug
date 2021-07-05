<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $table = 'post';
    protected $connection = 'mysql';

    public static function archives()
    {
        return static::selectRaw('year(updated_at) year, monthname(updated_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(updated_at) desc')
            ->get()
            ->toArray();
    }
}
