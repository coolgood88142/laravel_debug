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
        $sum = 0;
        // $data = Post::cursor()->sortBy('id')->map(function($value){
        //     return $value->id;
        // });  

        $data = LazyCollection::make(function() {   
            $posts = Post::all()->sortBy('id');
            
            foreach ($posts as $post){ 
                yield $post->id;
            }
        });

        $sum = $data->sum();


        // $post = Post::cursor()->tapEach(function ($value) {
        //     dump($value->id);
        // });

        // $data = $post->take(3)->all();
        // dd($data);

        // $post = Post::cursor()->remember();
        // $post->take(1)->all();
        // $post->take(3)->all();
            

        // dd($sum);


        dd(number_format(memory_get_peak_usage() / 1048576, 2) . 'MB');


        // return $data ;
    }

    public function yield_posts($posts){
        foreach ($posts as $post){ 
            yield $post->id;
        }
    }

    public function save(){
        echo 'test';
    }
}
