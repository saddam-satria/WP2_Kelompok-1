<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Service extends Migration
{
    public function up()
    {
        $this->forge->addField(array(
            "serviceID" => array(
                "type" => "INT",
                "constraint" => 3,
                "auto_increment" => true
            ),
            "serviceName" => array(
                "type" => "VARCHAR",
                "constraint" => 100,
            ),
            "servicePrice" => array(
                "type" => "FLOAT",
                "default" => 0
            ),
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ));

        $this->forge->addPrimaryKey("serviceID");
        $this->forge->addUniqueKey(array("serviceName"));
        $this->forge->createTable("service");
    }

    public function down()
    {
        $this->forge->dropTable("service");
    }
}
