<?php

namespace App\Models;


use Michalsn\Uuid\UuidModel;

class Account extends UuidModel
{
    protected $table            = 'account';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = array(
        "email", "firstname", "lastname", "address", "image", "gender", "verificationCode",
        "isMember", "isAdmin", "password"
    );
    protected $uuidVersion = "uuid4";
    protected $uuidUseBytes = false;

    // Validation
    protected $validationRules      = array(
        "email" => "required|valid_email|is_unique[account.email]"
    );
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ["hashingPassword", "setVerificationCode", "transformToLower"];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function transformToLower(array $data)
    {
        $data = $data["data"];

        $data["email"] = strtolower($data["email"]);
        $data["firstname"] = strtolower($data["firstname"]);
        $data["address"] = strtolower($data["address"]);

        if (isset($data["lastname"])) {
            $data["lastname"] = strtolower($data["lastname"]);
        }

        $data["data"] = $data;

        return $data;
    }

    public function hashingPassword(array $data)
    {
        $data = $data["data"];
        $data["password"] = password_hash($data["password"], PASSWORD_BCRYPT);
        $data["data"] = $data;
        return $data;
    }
    public function setVerificationCode(array $data)
    {
        $payload = $data["email"] . "-" . date_create()->getTimestamp();
        define("SECRET_KEY", "LAUNDRY WAR");
        $data = $data["data"];
        $data["verificationCode"] = strtoupper(hash_hmac("sha256", $payload, SECRET_KEY));
        $data["data"] = $data;
        return $data;
    }
}
