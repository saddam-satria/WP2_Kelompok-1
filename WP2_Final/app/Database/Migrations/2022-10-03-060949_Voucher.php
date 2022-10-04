<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Voucher extends Migration
{
    public function up()
    {
        $this->forge->addField(
            array(
                "voucherID" => array(
                    "type" => "INT",
                    "constraint" => 3,
                    "auto_increment" => true
                ),
                "voucherCode" => array(
                    "type" => "VARCHAR",
                    "constraint" => 10,
                ),
                "discount" => array(
                    "type" => "FLOAT",
                    "default" => 0
                ),
                "isPercentage" => array(
                    "type" => "BOOLEAN",
                    "default" => false
                ),
                "expire" => array(
                    "type" => "DATE",
                    "null" => true
                ),
                'created_at datetime default current_timestamp',
                'updated_at datetime default current_timestamp on update current_timestamp',
            )
        );
        $this->forge->addPrimaryKey(array("voucherID"));
        $this->forge->addUniqueKey(array("voucherCode"));
        $this->forge->createTable("voucher");
    }

    public function down()
    {
        $this->forge->dropTable("voucher");
    }
}
