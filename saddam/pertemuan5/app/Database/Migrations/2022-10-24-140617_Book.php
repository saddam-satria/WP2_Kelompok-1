<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Book extends Migration
{
    public function up()
    {
        $this->forge->addField(array(
            "bookId" => array(
                "type" => "INT",
                "null" => false,
                "auto_increment" =>  true,
            ),
            "title" => array(
                "type" => "VARCHAR",
                "constraint" => 128,
            ),
            "category_id" => array(
                "type" => "INT",
                "constraint" => 11
            ),
            "author" => array(
                "type" => "VARCHAR",
                "constraint" => 64
            ),
            "production" => array(
                "type" => "VARCHAR",
                "constraint" => 64
            ),
            "isbn" => array(
                "type" => "VARCHAR",
                "constraint" => 64
            ),
            "year" => array(
                "type" => "YEAR",
            ),
            "stock" => array(
                "type" => "INT",
                "constraint" => 11,
                "default" => 0
            ),
            "booked" => array(
                "type" => "INT",
                "constraint" => 11,
                "default" => 0
            ),
            "borrowed" => array(
                "type" => "INT",
                "constraint" => 11,
                "default" => 0
            ),
            "image" => array(
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true
            ),
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ));

        $this->forge->addPrimaryKey(array("bookId"));
        $this->forge->createTable("book");
    }

    public function down()
    {
        $this->forge->dropTable("book");
    }
}
