<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailOrder extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'detail_order';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = array(
        "order_id", "service", "package", "item", "quantity", "description", "progress"
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
    protected $beforeInsert   = ["transformToLower"];
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

        $data["description"] = strtolower($data["description"]);
        $data["package"] = strtolower($data["package"]);
        $data["item"] = strtolower($data["item"]);
        $data["service"] = strtolower($data["service"]);

        $data["data"] = $data;

        return $data;
    }
}
