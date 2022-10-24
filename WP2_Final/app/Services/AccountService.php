<?php

namespace App\Services;

use App\Repositories\AccountRepository;

class AccountService
{

    public $accountRepository;
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

        if ($isPasswordMatch) {
            $session = session();
            $sessionPayload = array(
                "current_user" => $this->accountRepository->getByID($user["id"]),
            );
            $session->set($sessionPayload);
        }

        return $isPasswordMatch;
    }
    public function signUp(string $email, string $firstname, string $lastname, string $password)
    {
        $response = $this->accountRepository->insertNewAccount($email, $firstname, $lastname, $password);
        return $response;
    }
    public function updateProfile($user_id, string $email, string $firstname, ?string $lastname, string $address, ?string $image, string $gender)
    {
        $data = array(
            "email" => $email,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "address" => $address,
            "image" => $image,
            "gender" => $gender
        );

        $response = $this->accountRepository->update($user_id, $data);
        var_dump($response);
    }
}
