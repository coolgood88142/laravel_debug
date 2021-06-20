<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ComputerService;

class ComputerController extends Controller
{
    public function result(Request $request){
        $type = $request->type;
        $a = $request->a;
        $b = $request->b;

        $result = $this->computer($type, $a, $b);


        return view('computer', 
        [ 
            'result' => $result,
            'a' => $a,
            'b' => $b
        ]);
    }

    public function computer($type, $a, $b){
        $service = new ComputerService();
        $result = '';
        if($type == 1){
            $result = $service->plus($a, $b);
        }else if($type == 2){
            $result = $service->toSubtract($a, $b);
        }else if($type == 3){
            $result = $service->multiply($a, $b);
        }else if($type == 4){
            $result = $service->divided($a, $b);
        }

        $service->addData($result);

        return $result;
    }

    public function addResult(){
        $result = 10;
        $service = new ComputerService();
        $service->addData($result);
    }
}
