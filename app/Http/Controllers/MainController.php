<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as Debugbar;

class MainController extends Controller
{
    public function getMainData(){
        clock()->event('Importing tweets')->color('purple')->begin();
        $array = [1,2,3];
        $sum = 0;
        foreach($array as $value){
            $sum += $value;
        }
        clock()->event('Importing tweets')->end();

        Debugbar::info('test');
        Debugbar::error('Error!');
        Debugbar::warning('Watch out…');
        Debugbar::addMessage('Another message', 'mylabel');

        //$this->addCollector(new ClockworkCollector($request, $response, 'test'));
        return view('welcome');
    }
    

}
