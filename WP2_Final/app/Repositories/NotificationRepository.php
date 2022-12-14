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
        $this->allowCallbacks();
    }
    public function getNotificationByAccount(string $email, array $columns = ["*"])
    {
        return $this->notificationTable->where("to", $email)->orderBy("created_at", "DESC")->select($columns)->get()->getResultObject();
    }
    public function getNotificationByAccountWhereNotRead(string $email, array $columns = ["*"])
    {
        return $this->notificationTable->where("to", $email)->orderBy("created_at", "DESC")->where("isRead", false)->select($columns)->get()->getResultObject();
    }
}
