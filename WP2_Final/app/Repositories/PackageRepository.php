<?php

namespace App\Repositories;

use App\Models\Package;

class PackageRepository extends Package
{
    private $packageTable;
    public function __construct()
    {
        $database = \Config\Database::connect();
        $this->packageTable =  $database->table("package");
        $this->allowCallbacks();
    }
    public function getPackages(array $columns = ["*"])
    {
        return $this->packageTable->select($columns)->get()->getResultObject();
    }
    public function getPackageByName(string $packageName, $columns = ["*"])
    {
        return $this->packageTable->select($columns)->where("packageName", $packageName)->get()->getResultObject();
    }
    public function getRawPackages(array $columns =[ "*"])
    {
        return $this->packageTable->select($columns);
    }
    public function getPackageByID(string $id, array $columns=["*"])
    {
        return $this->packageTable->select($columns)->where("packageID", $id)->get()->getResultObject();
    }
}
