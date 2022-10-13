<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $services = array(
            array(
                "name" => "nyuci",
                "image" => "assets/img/nyuci.png"
            ),
            array(
                "name" => "gosok",
                "image" => "assets/img/gosok.png"
            ),
            array(
                "name" => "all in one",
                "image" => "assets/img/allinone.png"
            ),
            array(
                "name" => "sneakers",
                "image" => "assets/img/sneakers.png"
            ),
        );
        return view("user/dashboard", compact("services"));
    }
    public function orders()
    {
        $title = "Cucian Anda";
        return view("user/order/index", compact("title"));
    }
    public function histories()
    {
        $title = "Riwayat Cucian Anda";
        return view("user/order/history", compact("title"));
    }
    public function add()
    {
        $title = "Tambah Cucian Baru";
        $default_service = $this->request->getVar("service");
        $services = array("nyuci", "gosok", "all in one", "sneakers");
        $packages = array("premium", "standart", "super");
        return view("user/order/insert", compact("title", "default_service", "services", "packages"));
    }
}
