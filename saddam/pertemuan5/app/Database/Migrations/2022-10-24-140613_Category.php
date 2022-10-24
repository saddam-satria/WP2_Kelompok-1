<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Category extends Migration
{
    public function up()
    {
        $this->forge->addField(array(
            "categoryId" => array(
                "type" => "INT",
                "null" => false,
                "auto_increment" =>  true,
            ),
            "categoryName" => array(
                "type" => "VARCHAR",
                "constraint" => 45,
            ),
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ));

        $this->forge->addPrimaryKey(array("categoryId"));
        $this->forge->createTable("category");
    }

    public function down()
    {
        $this->forge->dropTable("category");
    }
}
