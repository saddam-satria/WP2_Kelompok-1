<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Item extends Migration
{
    public function up()
    {
        $this->forge->addField(array(
            "itemID" => array(
                "type" => "INT",
                "constraint" => 3,
                "auto_increment" => true
            ),
            "itemName" => array(
                "type" => "VARCHAR",
                "constraint" => 100,
            ),
            "itemPrice" => array(
                "type" => "FLOAT",
                "default" => 0
            ),
            "quantityPerKG" => array(
                "type" => "INT",
                "default" => 0
            ),
            "itemLogo" => array(
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true
            ),
            "isSneaker" => array(
                "type" => "BOOLEAN",
                "default" => false
            ),
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ));
        $this->forge->addPrimaryKey("itemID");
        $this->forge->addUniqueKey(array("itemName"));
        $this->forge->createTable("item");
    }

    public function down()
    {
        $this->forge->dropTable("item");
    }
}
