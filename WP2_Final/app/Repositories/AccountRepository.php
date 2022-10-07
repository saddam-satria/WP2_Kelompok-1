<?php

namespace App\Repositories;

use App\Models\Account;

class AccountRepository extends Account
{
    public function getByEmail(string $email)
    {

        return $this->where("email", $email)->findAll();
    }
}
