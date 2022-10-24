<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField(array(
            "id" => array(
                "type" => "INT",
                "null" => false,
                "auto_increment" =>  true,
            ),
            "email" => array(
                "type" => "VARCHAR",
                "constraint" => 150,
                "unique" => true
            ),
            "name" => array(
                "type" => "VARCHAR",
                "constraint" => 128,
            ),
            "password" => array(
                "type" => "VARCHAR",
                "constraint" => 255
            ),
            "image" => array(
                "type" => "VARCHAR",
                "constraint" => 128
            ),
            "is_active" => array(
                "type" => "BOOLEAN",
            ),
            "role_id" => array(
                "type" => "INT"
            ),
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ));

        $this->forge->addPrimaryKey(array("id"));
        $this->forge->addForeignKey("role_id", "role", "id");
        $this->forge->createTable("user");
    }

    public function down()
    {
        $this->forge->dropTable("user");
    }
}
