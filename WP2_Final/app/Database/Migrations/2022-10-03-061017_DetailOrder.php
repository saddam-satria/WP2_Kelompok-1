<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailOrder extends Migration
{
    public function up()
    {
        $this->forge->addField(
            array(
                "order_id" => array(
                    "type" => "VARCHAR",
                    "constraint" => 150
                ),
                "item_id" => array(
                    "type" => "INT",
                ),
                "quantity" => array(
                    "type" => "INT",
                ),
                "description" => array(
                    "type" => "TEXT",
                ),
                'created_at datetime default current_timestamp',
                'updated_at datetime default current_timestamp on update current_timestamp',
            )
        );
        // $this->forge->addForeignKey("service_id", "service", "serviceID", "CASCADE", "CASCADE");
        // $this->forge->addForeignKey("package_id", "package", "packageID", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("order_id", "laundry_order", "id", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("item_id", "item", "itemID", "CASCADE", "CASCADE");
        $this->forge->createTable("detail_order");
    }

    public function down()
    {
        $this->forge->dropTable("detail_order");
    }
}
