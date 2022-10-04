<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Package extends Migration
{
    public function up()
    {
        $this->forge->addField(
            array(
                "packageID" => array(
                    "type" => "INT",
                    "constraint" => 3,
                    "auto_increment" => true
                ),
                "packageName" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100,
                ),
                "packagePrice" => array(
                    "type" => "FLOAT",
                    "default" => 0
                ),
                'created_at datetime default current_timestamp',
                'updated_at datetime default current_timestamp on update current_timestamp',
            )
        );
        $this->forge->addUniqueKey(array("packageName"));
        $this->forge->addPrimaryKey(array("packageID"));
        $this->forge->createTable("package");
    }

    public function down()
    {
        $this->forge->dropTable("package");
    }
}
