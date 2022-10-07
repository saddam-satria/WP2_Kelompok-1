<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Repositories\AccountRepository;
use App\Services\AccountService;

class RegisterController extends BaseController
{
    private $accountService;
    public function __construct()
    {
        $this->accountService = new AccountService(new AccountRepository());
    }
    public function index()
    {
        return view("auth/register");
    }
    public function signup()
    {
        $email = $this->request->getVar("email");
        $firstname = $this->request->getVar("firstname");
        $lastname = $this->request->getVar("lastname");
        $password = $this->request->getVar("password");


        $result = $this->accountService->signUp($email, $firstname, $lastname, $password);
    }
}
