<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Notification;

class NotificationController extends BaseController
{
    private  $notificationModel;
    public function __construct()
    {
        $this->notificationModel = new Notification();
    }
    public function index(string $id)
    {
        $title = "Detail Notifikasi";
        $notification = $this->notificationModel->where("notificationId", $id)->get()->getResultObject();

        if (is_null($notification)) {
            return redirect()->to("/user/dashboard");
        }


        $notification = $notification[0];


        return view("user/notification/detail", compact("title", "notification"));
    }
    public function updateIsRead(string $id)
    {
        $data = array(
            "isRead" => true
        );

        $result = $this->notificationModel->update($id, $data);

        if (!$result) {
            return redirect()->to("/user/dashboard");
        }


        return redirect()->to(base_url("/user/notification/" . $id));
    }
}
