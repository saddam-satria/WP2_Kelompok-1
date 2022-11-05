<?php

namespace App\Models;

use Michalsn\Uuid\UuidModel;
// use CodeIgniter\Model;

class Order extends UuidModel
{
    protected $table            = 'laundry_order';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = array(
        "account_id", "totalItem", "paymentMethod", "status", "token", "amount", "isFinish", "isTrouble", "description", "discount", "voucherCode", "payment", "service_id", "package_id",
    );
    protected $uuidVersion = "uuid4";
    protected $uuidUseBytes = false;

    // Validation
    protected $validationRules      = array();
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ["setToken", "transformToLower"];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function setToken(array $data)
    {
        helper("text");
        $data = $data["data"];
        $data["token"] = random_string("alnum", 8);
        $data["data"] = $data;

        return $data;
    }
    public function transformToLower(array $data)
    {
        $data = $data["data"];

        $data["description"] = strtolower($data["description"]);
        $data["paymentMethod"] = strtolower($data["paymentMethod"]);

        $data["data"] = $data;

        return $data;
    }
}
