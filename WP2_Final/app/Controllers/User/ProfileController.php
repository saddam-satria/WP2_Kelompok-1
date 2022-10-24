<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Repositories\AccountRepository;
use App\Services\AccountService;

class ProfileController extends BaseController
{
    private $accountService;
    public function __construct()
    {
        $this->accountService = new AccountService(new AccountRepository());
    }
    public function index()
    {
        if ($this->request->getVar("edit") && $this->request->getVar("edit") == 1) {
            return $this->edit();
        }

        $currentUser = $this->accountService->accountRepository->getByID(session()->current_user[0]["id"], array("firstname", "email", "lastname", "gender", "image", "address"));
        $currentUser = $currentUser[0];

        // dd($currentUser);

        return view("user/profile/index", compact("currentUser"));
    }
    private function edit()
    {
        $avatars = array(
            "assets/img/avatar.jpg", "assets/img/mickey-mouse.png", "assets/img/spongebob.png", "assets/img/doraemon.png",
        );
        return view("user/profile/edit", compact("avatars"));
    }
    public function update()
    {
        $rules = array(
            "firstname" => array("required", "max_length[100]"),
            "lastname" => array("max_length[100]"),
            "email" => array("required", "valid_email"),
        );

        if (!$this->validate($rules)) {
            helper("form");
            $validation = $this->validator;
            $avatars = array(
                "assets/img/avatar.jpg", "assets/img/mickey-mouse.png", "assets/img/spongebob.png", "assets/img/doraemon.png",
            );
            return view("user/profile/edit", compact("avatars", "validation"));
        }

        $avatar = $this->request->getVar("avatar") == "" ? null : $this->request->getVar("avatar");
        $result = $this->accountService->updateProfile(session()->current_user[0]["id"], $this->request->getVar("email"), $this->request->getVar("firstname"), $this->request->getVar("lastname"), $this->request->getVar("address"), $avatar, $this->request->getVar("gender"));
    }
}
