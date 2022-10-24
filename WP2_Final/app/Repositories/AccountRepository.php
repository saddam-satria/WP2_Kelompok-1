<?php

namespace App\Repositories;

use App\Models\Account;

class AccountRepository extends Account
{
    private $query;
    public function __construct()
    {
        $db = \Config\Database::connect();
        $this->query = $db->table("account");
    }
    public function getByEmail(string $email, $columns = array("*"))
    {
        return $this->query->select($columns)->where("email", $email)->get()->getResultObject();
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
    public function getByID(string $id, $columns = "*")
    {
        return $this->query->select($columns)->where("id", $id)->get()->getResultObject();
    }
}
