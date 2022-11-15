<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class LoginController extends BaseController
{
    public function index()
    {
        return view("auth/login");
    }
    public function login()
    {
        $email = $this->request->getVar("email");
        $password = $this->request->getVar("password");

        $data = array(
            "email" => $email,
            "password" => $password
        );

        if($email != "admin@gmail.com" || $password != "admin"){
            return redirect()->to(base_url("auth/login"));
        }


        return redirect()->to(base_url("/"));



    }
}
