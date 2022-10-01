<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Account extends Migration
{
    public function up()
    {

        $this->forge->addField(array(
            "id" => array(
                "type" => "VARCHAR",
                "constraint" => 150,
            ),
            "firstname" => array(
                "type" => "VARCHAR",
                "constraint" => 100,
            )
        ));
        $this->forge->addPrimaryKey("id");
        $this->forge->createTable("account");
    }

    public function down()
    {
        $this->forge->dropTable("account");
    }
}
