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

        $currentUser = $this->accountService->accountRepository->getByID(session()->current_user[0]->id, array("firstname", "email", "lastname", "gender", "image", "address"));
        $currentUser = $currentUser[0];

        // dd($currentUser);

        return view("user/profile/index", compact("currentUser"));
    }
    private function edit()
    {
        $avatars = array(
            "assets/img/avatar.jpg", "assets/img/mickey-mouse.png", "assets/img/spongebob.png", "assets/img/doraemon.png",
        );

        $currentUser = $this->accountService->accountRepository->getByID(session()->current_user[0]->id, array("firstname", "email", "lastname", "gender", "image", "address"));
        $currentUser = $currentUser[0];

        return view("user/profile/edit", compact("avatars", "currentUser"));
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
        $result = $this->accountService->updateProfile(session()->current_user[0]->id, $this->request->getVar("email"), $this->request->getVar("firstname"), $this->request->getVar("lastname"), $this->request->getVar("address"), $avatar, $this->request->getVar("gender"));

        if ($result) return redirect()->to(base_url('/user/profile'))->with("success", "berhasil update profile");
    }
    public function updatePassword()
    {

        $rules = array(
            "old_password" => array("required"),
            "new_password" => array("required", "min_length[8]"),
            "confirmation_new_password" => array("matches[new_password]", "required")
        );


        if (!$this->validate($rules)) {
            helper("form");
            $validation = $this->validator;
            $currentUser = $this->accountService->accountRepository->getByID(session()->current_user[0]->id, array("firstname", "email", "lastname", "gender", "image", "address"));
            $currentUser = $currentUser[0];

            return view("user/profile/index", compact("validation", "currentUser"));
        }

        $session = session();
        $user_id = $session->current_user[0]->id;
        $new_password = $this->request->getVar("new_password");
        $old_password = $this->request->getVar("old_password");
        $result = $this->accountService->updatePassword($user_id, $new_password, $old_password);

        if (!$result) return redirect()->to(base_url("/user/profile"))->with("error", "password salah");


        return redirect()->to(base_url("/user/profile"))->with("success", "berhasil mengubah password");
    }
}
