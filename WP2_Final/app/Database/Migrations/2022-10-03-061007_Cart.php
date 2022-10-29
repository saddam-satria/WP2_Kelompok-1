<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cart extends Migration
{
    public function up()
    {
        $this->forge->addField(
            array(
                "account_id" => array(
                    "type" => "VARCHAR",
                    "constraint" => 150,
                ),
                "service" => array(
                    "type" => "VARCHAR",
                    "constraint" => 50
                ),
                "package" => array(
                    "type" => "VARCHAR",
                    "constraint" => 50
                ),
                "item" => array(
                    "type" => "VARCHAR",
                    "constraint" => 50
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
        // $this->forge->addForeignKey("service_id", "service", "serviceID", "CASCADE", "CASCADE");
        // $this->forge->addForeignKey("package_id", "package", "packageID", "CASCADE", "CASCADE");
        // $this->forge->addForeignKey("item_id", "item", "itemID", "CASCADE", "CASCADE");
        $this->forge->createTable("cart");
    }

    public function down()
    {
        $this->forge->dropTable("cart");
    }
}
