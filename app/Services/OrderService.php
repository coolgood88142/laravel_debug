<?php 

namespace App\Services;

class OrderService 
{
    public function newOrder($data){
        return $data[0];
    }
}