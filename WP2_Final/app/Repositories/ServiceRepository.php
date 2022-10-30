<?php

namespace App\Repositories;

use App\Models\Service;

class ServiceRepository extends Service
{
    private $serviceTable;
    public function __construct()
    {
        $database = \Config\Database::connect();
        $this->serviceTable =  $database->table("service");
    }
    public function getServices($columns = array("*"))
    {
        return $this->serviceTable->select($columns)->get()->getResultArray();
    }
    public function getServiceByName(string $serviceName, $columns = ["*"])
    {
        return $this->serviceTable->select($columns)->where("serviceName", $serviceName)->get()->getResultObject();
    }
}
