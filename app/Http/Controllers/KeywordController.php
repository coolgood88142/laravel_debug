<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Cache;

class KeywordController extends Controller
{
    public function getKeywordView(){
        $pagination = $this->getPaginationData(1);
        $from = $pagination['from'];
        $perPage = $pagination['perPage'];
        $data = Keyword::all();
        $keyword = $data->splice($from, $perPage);
        $response = [
            'pagination' => $pagination,
            'keyword' => $keyword, 'add' => route('addKeyword'), 'update' => route('updateKeyword'),
            'delete' => route('deleteKeyword')
        ];

        return view('keyword', ['data' => $response]);
    }

    public function getKeywordData($from, $perPage){
        // clock()->event('Importing tweets')->color('purple')->begin();
        $keyword = Keyword::all()->splice($from, $perPage);
        // clock()->event('Importing tweets')->end();
        return $keyword;
    }

    public function getPaginationData($page){
        $perPage = 5;
        $from= ($page * $perPage) - ($perPage - 1) - 1;
        $total = Keyword::count();
        $pagination = [
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => ceil($total / $perPage),
            'from' => $from,
            'to' => $page * $perPage,
            'perPage' => $perPage
        ];
        return $pagination;
    }

    public function getPagination(Request $request){
        $page = (int)$request->page;
        $pagination = $this->getPaginationData($page);
        $from = $pagination['from'];
        $perPage = $pagination['perPage'];
        $keyword = $this->getKeywordData($from, $perPage);

        $response = [
            'pagination' => $pagination,
            'keyword' => $keyword
        ];

        return response()->json($response);
    }

    public function checkKeywordData($id)
    {
        $isSuccess = false;
        $data = Keyword::all()->contains($id);
        if ($data > 0) {
            $isSuccess = true;
        }

        return $isSuccess;
    }

    public function addKeywordData(Request $request)
    {
        $en = $request->en;
        $tc = $request->tc;
        $datetime = Carbon::now();
        $status = 'success';
        $message = '新增成功!';

        try {
            $keyword = new Keyword();
            $keyword->en = $en;
            $keyword->tc = $tc;
            $keyword->created_at = $datetime;
            $keyword->updated_at = new Date();
            $keyword->save();
        } catch (Exception $e) {
            echo $e;
        }
        
        return [ 
            'status' => $status,
            'message' => $message 
        ];
    }

    public function updateKeywordData(Request $request){
        $id = $request->id;
        $en = $request->en;
        $tc = $request->tc;
        $datetime = Carbon::now();
        $status = 'success';
        $message = '更新成功!';

        try {
            $check = $this->checkKeywordData($id);

            if ($check) {
                $keyword = Keyword::find($id);
                $keyword->en = $en;
                $keyword->tc = $tc;
                $keyword->updated_at = $datetime;
                $keyword->save();
            } else {
                $status = 'error';
                $message = '更新失敗!';
            }
            
        } catch (Exception $e) {
            echo $e;
        }
        
        return [
            'status' => $status,
            'message' => $message 
        ];
    }

    public function deleteKeywordData(Request $request){
        $id = $request->id;
        $status = 'success';
        $message = '刪除成功!';

        try {
            $check = $this->checkKeywordData($id);

            if ($check) {
                $keyword = Keyword::find($id);
                $keyword->delete();
            } else {
                $status = 'error';
                $message = '刪除失敗!';
            }

        } catch (Exception $e) {
            echo $e;
        }
        
        return [
            'status' => $status,
            'message' => $message
        ];
    }

    public function test1(){
        $datas = Keyword::all();

        foreach ($datas as $data) {
            echo $data;
        }
    }

    public function test2(){
        $datas = Keyword::cursor();

        foreach ($datas as $data) {
            echo $data;
        }
    }

    public function test3(){
        $articles = LazyCollection ::make(function() {
            $url = 'https://my-json-server.typicode.com/coolgood88142/json_server/articles';
            $handle = fopen($url, 'r');

            while ($line = fgets($handle)) {
                yield $line;
            }
        });

        foreach ($articles as $line) {
            echo $line . '<br/>';
        }
    }

    public function cache(){
        \DB::enableQueryLog();
        // Keyword::all();
        $value = Cache::remember('keyword', 180, function () {
            return Keyword::all();
        });
        dd(\DB::getQueryLog());
    }

}
