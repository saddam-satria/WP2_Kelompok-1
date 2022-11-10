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
        $this->allowCallbacks();
    }
    public function getServices($columns = array("*"))
    {
        return $this->serviceTable->select($columns)->get()->getResultObject();
    }
    public function getServiceByName(string $serviceName, $columns = ["*"])
    {
        return $this->serviceTable->select($columns)->where("serviceName", $serviceName)->get()->getResultObject();
    }
    public function getRawServices(array $columns=["*"])
    {
        return $this->serviceTable->select($columns)->orderBy("created_at","DESC");
    }
}
