<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }
    public function rental(){
        $judul = "Rental Mobil";
        return view("pertemuan4/index");
    }
}
