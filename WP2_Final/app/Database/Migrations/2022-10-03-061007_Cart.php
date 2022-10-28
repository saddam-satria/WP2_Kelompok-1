<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailCart extends Migration
{
    public function up()
    {
        $this->forge->addField(
            array(
                "account_id" => array(
                    "type" => "VARCHAR",
                    "constraint" => 150,
                ),
                "service_id" => array(
                    "type" => "INT",
                    "constraint" => 3,
                ),
                "package_id" => array(
                    "type" => "INT",
                    "constraint" => 3,
                ),
                "item_id" => array(
                    "type" => "INT",
                    "constraint" => 3,
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
        $this->forge->addForeignKey("account_id", "account", "id", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("service_id", "service", "serviceID", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("package_id", "package", "packageID", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("item_id", "item", "itemID", "CASCADE", "CASCADE");
        $this->forge->createTable("cart");
    }

    public function down()
    {
        $this->forge->dropTable("cart");
    }
}
