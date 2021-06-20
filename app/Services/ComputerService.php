<?php 

namespace App\Services;

use App\Models\Computer;

class ComputerService 
{  
    public function plus($a, $b){
        return $a + $b;
    }

    public function toSubtract($a, $b){
        return $a - $b;
    }

    public function multiply($a, $b){
        return $a * $b;
    }

    public function divided($a, $b){
        return $a / $b;
    }

    public function addData($result){
            $computer = new Computer();
            $computer->result1 = $result;
            $computer->save();

        return 'success';
    }
}