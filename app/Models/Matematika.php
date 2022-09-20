<?php

namespace App\Models;

use CodeIgniter\Model;

class Matematika extends Model
{
    public $value1,$value2,$value3;

    public function sum(int $value1,int $value2){
        $this->value1=$value1;
        $this->value2=$value2;
        return $this->value1 + $this->value2;;
    }

}
