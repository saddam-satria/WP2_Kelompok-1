<?php

namespace App\Database\Seeds;

use App\Models\Notification as ModelsNotification;
use CodeIgniter\Database\Seeder;

class Notification extends Seeder
{
    public function run()
    {
        $data = array("to" => "admin@gmail.com", "from" => "admin sistem", "message" => "testing aja");

        $notificationModel = new ModelsNotification();

        $notificationModel->insert($data);
    }
}
