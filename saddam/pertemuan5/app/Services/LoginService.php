<?php
namespace App\Services;
use App\Models\User;

class LoginService{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }
    public function login($email,$password)
    {
        $user = $this->userModel->where("email", $email)->find();

        if(count($user) < 0){
            return false;
        }

        $user = $user[0];

        $password = password_verify($password, $user["password"]);

        if($password){
            $session = session();

            $payload = array("current_user" => $user);
            $session->set($payload);
            return true;
        }
        
        return false;

    }
}