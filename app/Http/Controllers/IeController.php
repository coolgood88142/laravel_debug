<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
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

        return view('ie');
    }

    public function save(){
        echo 'test';
    }
}
