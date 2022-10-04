<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VoucherOnAccount extends Migration
{
    public function up()
    {
        $this->forge->addField(
            array(
                "voucher_id" => array(
                    "type" => "INT",
                    "constraint" => 3,
                ),
                "account_id" => array(
                    "type" => "VARCHAR",
                    "constraint" => 150,
                ),
                'created_at datetime default current_timestamp',
                'updated_at datetime default current_timestamp on update current_timestamp',
            )
        );
        $this->forge->addForeignKey("voucher_id", "voucher", "voucherID", "CASCADE", "NULL");
        $this->forge->addForeignKey("account_id", "account", "id", "CASCADE", "NULL");
        $this->forge->createTable("voucher_on_account");
    }

    public function down()
    {
        $this->forge->dropTable("voucher_on_account");
    }
}
