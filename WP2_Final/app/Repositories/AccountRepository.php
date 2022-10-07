<?php

namespace App\Repositories;

use App\Models\Account;

class AccountRepository extends Account
{
    public function getByEmail(string $email)
    {

        return $this->where("email", $email)->findAll();
    }
    public function insertNewAccount(
        string $email,
        string $firstname,
        string $lastname,
        string $password,
        ?string $address = null,
        ?string $image = null,
        ?string $gender = null,
        bool $isAdmin = false,
        bool $isMember = false
    ) {
        $data = array(
            "email" => $email,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "password" => $password,
            "address" => $address,
            "image" => $image,
            "isMember" => $isMember,
            "isAdmin" => $isAdmin,
            "gender" => $gender
        );
        return $this->insert($data);
    }
}
