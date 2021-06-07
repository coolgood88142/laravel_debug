<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;

class ArticlesController extends Controller
{
    private $user;
    private $rule;

    public function getArticlesData(){
        $articles = Articles::all();
        $url = '`https://my-json-server.typicode.com/coolgood88142/json_server/titles`';
        return $articles;
    }

    public function checkArticlesData($id)
    {
        $isSuccess = false;
        $data = Articles::all()->contains($id);
        if ($data > 0) {
            $isSuccess = true;
        }

        return $isSuccess;
    }

    public function addArticlesData(Request $request)
    {
        $en = $request->en;
        $tc = $request->tc;
        $datetime = Carbon::now();
        $status = 'success';
        $message = '新增成功!';

        try {
            $articles = new Articles();
            $articles->en = $en;
            $articles->tc = $tc;
            $articles->created_at = $datetime;
            $articles->updated_at = new Date();
            $articles->save();
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
            $check = $this->checkAticlesData($id);

            if ($check) {
            $articles = Articles::find($id);
            $articles->en = $en;
                $articles->tc = $tc;
                $articles->updated_at = $datetime;
                $articles->save();
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

    public function deleteAticlesData(Request $request){
        $id = $request->id;
        $status = 'success';
        $message = '刪除成功!';

        try {
            $check = $this->checkArticlesData($id);

            if ($check) {
                $articles = Aticles::find($id);
                $articles->delete();
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

    public function getUserData(Request $request){
        $this->rule = [
            'start_date' => date('2013-01-01 00:00:00'),
            'end_date' => date('Y-m-d 23:59:59'),
        ];

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if (!empty($start_date) & !empty($end_date)) {
            $rule['start_date'] = date('Y-m-d 00:00:00', strtotime($start_date));
            $rule['end_date'] = date('Y-m-d 23:59:59', strtotime($end_date));
            $this->rule = $rule;
        }

        $this->user = new User();

        $histories = $this->user->whereBetween('exam_time', [$this->rule['start_date'], $this->rule['end_date']])
        ->orderBy('exam_time', 'DESC')->paginate(3);
        dd($histories);

        if (!empty($start_date) & !empty($end_date)) {
            $histories = $this->getPageAppend($histories, $this->rule);
            dd($histories);
        }
    }

    public function getExamCountByUser($user, $exam_history_ary, $rule)
    {
        $count = $user->examHistories()
            ->whereBetween('exam_time', [$rule['start_date'], $rule['end_date']])
            ->count();

        return $count;
    }

    public function getPageAppend($histories, $rule)
    {
        //找appends是幹嘛的
        $histories->appends([
            'start_date' => date('Y-m-d', strtotime($rule['start_date'])),
            'end_date' => date('Y-m-d', strtotime($rule['end_date'])),
        ]);
        return $histories;
    }

}
