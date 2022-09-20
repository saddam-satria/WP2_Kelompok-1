<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Matematika;

class Biodata extends BaseController
{
    private $matematikaModel;

    public function __construct()
    {
        $this->matematikaModel = new Matematika();
    }


    public function index()
    {
        $data = 'satria';
        return view("biodata", compact("data"));
    }
    public function matematika($value1,$value2){

        // $value1= $this->request->getVar("value1");
        // $value2 = $this->request->getVar("value2");
        
        $result = $this->matematikaModel->sum((int)$value1,(int)$value2);

        echo "Contoh 1 Selamat Datang Selamat Belajar Web Programming <br>";

        echo "Contoh 2: Hasil Penjumlahan Dari " . $value1. " + " . $value2 . "=" . $result;

        
        return view("example",compact("value1","value2", "result"));


    }
}
