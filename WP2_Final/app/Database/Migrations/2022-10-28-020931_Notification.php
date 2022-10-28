<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notification extends Migration
{
    public function up()
    {
        $this->forge->addField(
            array(
                "notificationId" => array(
                    "type" => "INT",
                    "auto_increment" => true,
                ),
                "to" => array(
                    "type" => "VARCHAR",
                    "constraint" => 150
                ),
                "FROM" => array(
                    "type" => "VARCHAR",
                    "constraint" => 150
                ),
                "message" => array(
                    "type" => "TEXT",
                )
            )
        );

        $this->forge->addPrimaryKey(array("notificationId"));
        $this->forge->createTable("notification");
    }

    public function down()
    {
        $this->forge->dropTable("notification");
    }
}
