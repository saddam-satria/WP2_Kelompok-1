<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
{
    public function up()
    {
        $this->forge->addField(
            array(
                "orderID" => array(
                    "type" => "VARCHAR",
                    "constraint" => 150,
                ),
                "account_id" => array(
                    "type" => "VARCHAR",
                    "constraint" => 150,
                ),
                "total" => array(
                    "type" => "FLOAT",
                    "default" => 0,
                ),
                "paymentMethod" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100,
                ),
                "orderStatus" => array(
                    "type" => "BOOLEAN",
                    "default" => false
                ),
                "token" => array(
                    "type" => "VARCHAR",
                    "constraint" => 15
                ),
                "discount" => array(
                    "type" => "FLOAT",
                    "default" => 0
                ),
                "status" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100,
                    "null" => true
                ),
                'created_at datetime default current_timestamp',
                'updated_at datetime default current_timestamp on update current_timestamp',
            )
        );
        $this->forge->addPrimaryKey("orderID");
        $this->forge->addUniqueKey(array("token"));
        $this->forge->addForeignKey("account_id", "account", "id", "CASCADE", "CASCADE");
        $this->forge->createTable("laundry_order");
    }

    public function down()
    {
        $this->forge->dropTable("laundry_order");
    }
}
