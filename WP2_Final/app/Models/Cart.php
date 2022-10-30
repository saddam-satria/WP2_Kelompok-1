<?php

namespace App\Models;


use Michalsn\Uuid\UuidModel;

class Cart extends UuidModel
{
    protected $table            = 'cart';
    protected $primaryKey       = 'cartId';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = array(
        "account_id", "service_id", "package_id", "cartId"
    );
    protected $uuidVersion = "uuid4";
    protected $uuidUseBytes = false;
    protected $uuidFields = array("cartId");

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
