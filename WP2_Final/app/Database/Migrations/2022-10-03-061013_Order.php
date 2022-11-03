<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
{
    public function up()
    {
        $this->forge->addField(
            array(
                "id" => array(
                    "type" => "VARCHAR",
                    "constraint" => 150,
                ),
                "account_id" => array(
                    "type" => "VARCHAR",
                    "constraint" => 150,
                ),
                "totalItem" => array(
                    "type" => "INT",
                    "default" => 0,
                ),
                "amount" => array(
                    "type" => "FLOAT",
                ),
                "status" => array(
                    "type" => "enum('DITERIMA', 'SEDANG DICUCI', 'SUDAH SELESAI', 'SUDAH DI AMBIL')"
                ),
                "paymentMethod" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100,
                    "null" => true
                ),
                "isFinish" => array(
                    "type" => "BOOLEAN",
                    "default" => false
                ),
                "isTrouble" => array(
                    "type" => "BOOLEAN",
                    "default" => false
                ),
                "description" => array(
                    "type" => "TEXT",
                    "null" => true
                ),
                "discount" => array(
                    "type" => "FLOAT",
                    "default" => 0
                ),
                "voucherCode" => array(
                    "type" => "VARCHAR",
                    "null" => true,
                    "constraint" => 20
                ),
                "token" => array(
                    "type" => "VARCHAR",
                    "constraint" => 15
                ),
                "payment" => array(
                    "type" => "float",
                ),
                "service_id" => array(
                    "type" => "INT",
                    "constraint" => 3,
                ),
                "package_id" => array(
                    "type" => "INT",
                    "constraint" => 3,
                ),
                'created_at datetime default current_timestamp',
                'updated_at datetime default current_timestamp on update current_timestamp',
            )
        );
        $this->forge->addPrimaryKey("id");
        $this->forge->addUniqueKey(array("token"));
        $this->forge->addForeignKey("account_id", "account", "id", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("service_id", "service", "serviceID", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("package_id", "package", "packageID", "CASCADE", "CASCADE");
        $this->forge->createTable("laundry_order");
    }

    public function down()
    {
        $this->forge->dropTable("laundry_order");
    }
}
