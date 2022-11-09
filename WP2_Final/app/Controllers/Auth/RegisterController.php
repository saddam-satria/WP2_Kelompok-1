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
        helper("form");
        return view("auth/register");
    }
    public function signup()
    {
        $email = $this->request->getVar("email");
        $firstname = $this->request->getVar("firstname");
        $lastname = $this->request->getVar("lastname");
        $password = $this->request->getVar("password");

        $rules = array(
            "email" => array("required", "valid_email", "is_unique[account.email]"),
            "firstname" => array("required"),
            "password" => array("required", "min_length[8]")
        );


        if (!$this->validate($rules)) {
            helper("form");
            $validation = $this->validator;
            return view("auth/register", compact("validation"));
        }


        $result = $this->accountService->signUp($email, $firstname, $lastname, $password);

        if(!$result) {
            return redirect()->to(base_url("auth/register"))->with("error","terjadi kesalahan");
        }
        return redirect()->to(base_url("auth/login"))->with("success","berhasil register, silahkan login");

    }
}
