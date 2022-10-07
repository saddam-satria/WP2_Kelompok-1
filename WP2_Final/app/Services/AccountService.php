<?php

namespace App\Services;

use App\Controllers\Auth\LoginController;
use App\Repositories\AccountRepository;

class AccountService
{

    private $accountRepository;
    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }
    public function login(string $email, string $password): bool
    {
        $user = $this->accountRepository->getByEmail($email);

        if (count($user) < 1) {
            return false;
        }

        $user = $user[0];
        $isPasswordMatch = password_verify($password, $user["password"]);


        return $isPasswordMatch;
    }
    public function signUp(string $email, string $firstname, string $lastname, string $password)
    {
        $response = $this->accountRepository->insertNewAccount($email, $firstname, $lastname, $password);

        return $response;
    }
}
