<?php

namespace App\Repositories;

use App\Models\Notification;

class NotificationRepository extends Notification
{
    private $notificationTable;
    public function __construct()
    {
        $database = \Config\Database::connect();
        $this->notificationTable =  $database->table("notification");
    }
    public function getNotificationByAccount(string $email, array $columns = ["*"])
    {
        return $this->notificationTable->where("to", $email)->select($columns)->get()->getResultObject();
    }
}
