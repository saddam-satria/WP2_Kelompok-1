<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailOrder extends Migration
{
    public function up()
    {
        $this->forge->addField(
            array(
                "cart_id" => array(
                    "type" => "INT",
                    "constraint" => 3,
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
                "progress" => array(
                    "type" => "enum('DITERIMA', 'SEDANG DICUCI', 'SUDAH SELESAI', 'SELESAI')"
                ),
                'created_at datetime default current_timestamp',
                'updated_at datetime default current_timestamp on update current_timestamp',
            )
        );
        $this->forge->addForeignKey("cart_id", "cart", "cartID", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("service_id", "service", "serviceID", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("package_id", "package", "packageID", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("item_id", "item", "itemID", "CASCADE", "CASCADE");
        $this->forge->createTable("detail_order");
    }

    public function down()
    {
        $this->forge->dropTable("detail_order");
    }
}
