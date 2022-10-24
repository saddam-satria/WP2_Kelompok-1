<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Role extends Migration
{
    public function up()
    {
        $this->forge->addField(array(
            "id" => array(
                "type" => "INT",
                "null" => false,
                "auto_increment" =>  true,
            ),
            "name" => array(
                "type" => "VARCHAR",
                "constraint" => 50,
            ),
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ));

        $this->forge->addPrimaryKey(array("id"));
        $this->forge->createTable("role");
    }

    public function down()
    {
        $this->forge->dropTable("role");
    }
}
