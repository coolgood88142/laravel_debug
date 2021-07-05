<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Cache;

class IeController extends Controller
{
    public function getData(){
        $data = 'test';
        $post = Post::cursor()->remember();
        $post->take(1)->all();
        $post->take(3)->all();

        dd($post);

        // $sum = $post->sum(); 
        // dd($post);
        dd(number_format(memory_get_peak_usage() / 1048576, 2) . 'MB');


        return $data ;
    }

    public function save(){
        echo 'test';
    }
}
