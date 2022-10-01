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
            "email" => array(
                "type" => "VARCHAR",
                "constraint" => 255,
            ),
            "firstname" => array(
                "type" => "VARCHAR",
                "constraint" => 100,
            ),
            "lastname" => array(
                "type" => "VARCHAR",
                "constraint" => 100,
                "null" => true
            ),
            "address" => array(
                "type" => "TEXT",
                "null" => true
            ),
            "image" => array(
                "type" => "varchar",
                "constraint" => 255,
                "null" => true
            ),
            "gender" => array(
                "type" => "enum('LAKI-LAKI', 'PEREMPUAN')",
                "null" => true
            ),
            "verificationCode" => array(
                "type" => "VARCHAR",
                "constraint" => 12,
            ),
            "isMember" => array(
                "type" => "BOOLEAN",
                "default" => false,
            ),
            "isAdmin" => array(
                "type" => "BOOLEAN",
                "default" => false,
            ),
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ));
        $this->forge->addPrimaryKey("id");
        $this->forge->addUniqueKey(array("email", "verificationCode"));
        $this->forge->createTable("account");
    }

    public function down()
    {
        $this->forge->dropTable("account");
    }
}
