<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ItemOnCart extends Migration
{
    public function up()
    {
        $this->forge->addField(
            array(
                "id" => array(
                    "type" => "INT",
                    "auto_increment" => true
                ),
                "cart_id" => array(
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
        $this->forge->addPrimaryKey(array("id"));
        $this->forge->addForeignKey("cart_id", "cart", "cartId", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("item_id", "item", "itemID", "CASCADE");
        $this->forge->createTable("item_on_cart");
    }

    public function down()
    {
        $this->forge->dropTable("item_on_cart");
    }
}
