<?php
namespace App\Repositories;

use App\Models\Item;

class ItemRepository extends Item{
    private $itemTable;
    public function __construct()
    {
        $database = \Config\Database::connect();
        $this->itemTable =  $database->table("item");
    }
    public function getItems(array $columns = ["*"])
    {
       return $this->itemTable->select($columns)->get()->getResultObject();
    }
}