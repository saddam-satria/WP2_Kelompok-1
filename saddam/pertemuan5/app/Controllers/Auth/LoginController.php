<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Services\LoginService;

class LoginController extends BaseController
{
    private $loginService;
    public function __construct()
    {
        $this->loginService = new LoginService();
    }
    public function index()
    {
        return view("login");
    }
    public function login()
    {
        $email = $this->request->getVar("email");
        $password = $this->request->getVar("password");

        $result = $this->loginService->login($email,$password);

        if(!$result) return "Gagal Login";


        return redirect()->to(base_url("user/dashboard"));

        
    }
}
