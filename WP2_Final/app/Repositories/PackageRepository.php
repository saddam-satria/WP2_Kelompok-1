<?php

namespace App\Repositories;

use App\Models\Item;

class PackageRepository extends Item
{
    private $packageTable;
    public function __construct()
    {
        $database = \Config\Database::connect();
        $this->packageTable =  $database->table("package");
    }
    public function getPackages(array $columns = ["*"])
    {
        return $this->packageTable->select($columns)->get()->getResultObject();
    }
    public function getPackageByName(string $packageName, $columns = ["*"])
    {
        return $this->packageTable->select($columns)->where("packageName", $packageName)->get()->getResultObject();
    }
}
