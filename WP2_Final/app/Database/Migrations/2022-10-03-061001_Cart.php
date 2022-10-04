<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cart extends Migration
{
    public function up()
    {
        $this->forge->addField(
            array(
                "cartID" => array(
                    "type" => "INT",
                    "constraint" => 3,
                    "auto_increment" => true
                ),
                "account_id" => array(
                    "type" => "VARCHAR",
                    "constraint" => 150,
                ),
                'created_at datetime default current_timestamp',
                'updated_at datetime default current_timestamp on update current_timestamp',
            )
        );
        $this->forge->addPrimaryKey("cartID");
        $this->forge->addForeignKey("account_id", "account", "id", "CASCADE", "CASCADE");
        $this->forge->createTable("cart");
    }

    public function down()
    {
        $this->forge->dropTable("cart");
    }
}
