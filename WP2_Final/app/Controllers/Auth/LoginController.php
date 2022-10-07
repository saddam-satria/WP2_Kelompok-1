<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Repositories\AccountRepository;
use App\Services\AccountService;

class LoginController extends BaseController
{
    private $accountService;
    public function __construct()
    {
        $this->accountService = new AccountService(new AccountRepository());
    }
    public function index()
    {
        return view("auth/login");
    }
    public function login()
    {

        $result = $this->accountService->login($this->request->getVar("email"), $this->request->getVar("password"));

        if (!$result) {
            return redirect()->to(base_url("auth/login"))->with("failure", "akun anda tidak ditemukan");
        }
    }
}
