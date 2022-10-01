<?php

namespace App\Models;

use App\Helpers\DatetimeHelper;
use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class Account extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'account';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = array(
        "email", "firstname", "lastname", "address", "image", "gender", "verificationCode",
        "isMember", "isAdmin",
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
    protected $beforeInsert   = ["addUUID"];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ["setUpdatedAt"];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function addUUID(array $data)
    {
        $uuid = Uuid::uuid4();
        $data["id"] = $uuid->toString();
        return $data;
    }
    public function setUpdatedAt(array $data)
    {
        $data["updated_at"] = DatetimeHelper::now();
        return $data;
    }
}
