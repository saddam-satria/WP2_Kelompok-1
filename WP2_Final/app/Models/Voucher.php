<?php

namespace App\Models;

use CodeIgniter\Model;

class Voucher extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'voucher';
    protected $primaryKey       = 'voucherID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = array(
        "discount", "isPercentage", "expire"
    );

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ["setVoucherCode"];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function setVoucherCode(array $data)
    {
        helper("text");
        $data = $data["data"];
        $data["voucherCode"] = random_string("alnum", 10);
        $data["data"] = $data;

        return $data;
    }
}
