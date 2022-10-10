<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{
    public function index()
    {
        if ($this->request->getVar("edit") && $this->request->getVar("edit") == 1) {
            return $this->edit();
        }
        return view("user/profile/index");
    }
    private function edit()
    {
        $avatars = array(
            "assets/img/avatar.jpg", "assets/img/mickey-mouse.png", "assets/img/spongebob.png", "assets/img/doraemon.png",
        );
        return view("user/profile/edit", compact("avatars"));
    }
}
