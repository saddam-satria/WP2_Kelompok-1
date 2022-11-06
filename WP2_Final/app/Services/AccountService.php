<?php

namespace App\Services;

use App\Models\Account;
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
        $isPasswordMatch = password_verify($password, $user->password);

        if ($isPasswordMatch) {
            $session = session();
            $sessionPayload = array(
                "current_user" => $this->accountRepository->getByID($user->id),
            );
            $session->set($sessionPayload);
        }

        return $isPasswordMatch;
    }
    public function signUp(string $email, string $firstname, string $lastname, string $password)
    {
        $accountModel = new Account();
        $data = array(
            "email" => $email, "firstname" =>  $firstname, "lastname" => $lastname, "password" => $password
        );
        $response = $accountModel->insert($data);
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

        if (!$response) return false;

        $session = session();
        $sessionPayload = array(
            "current_user" => $this->accountRepository->getByID($user_id),
        );
        $session->set($sessionPayload);

        return true;
    }
    public function updatePassword($user_id, $new_password, $old_password)
    {


        $user = $this->accountRepository->getByID($user_id, array("password"))[0];
        $prevPassword =  password_verify($old_password, $user->password);

        if (!$prevPassword) {
            return false;
        }

        $data = array(
            "password" => password_hash($new_password, PASSWORD_BCRYPT)
        );


        $response = $this->accountRepository->update($user_id, $data);

        return $response;
    }
}
