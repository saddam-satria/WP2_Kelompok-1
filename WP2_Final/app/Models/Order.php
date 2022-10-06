<?php

namespace App\Models;

use Michalsn\Uuid\UuidModel;
// use CodeIgniter\Model;

class Order extends UuidModel
{
    protected $table            = 'order';
    protected $primaryKey       = 'orderID';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = array(
        "account_id", "total", "paymentMethod", "orderStatus", "token", "discount"
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
    protected $beforeInsert   = ["setToken"];
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
}
