<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Account;
use App\Repositories\AccountRepository;
use Hermawan\DataTables\DataTable;

class UserController extends BaseController
{
    private $accountRepository;
    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
    }
    public function index()
    {
        $title = "Admin Data User";
        $isAdmin = $this->request->getVar("is_admin");
        return view("admin/user/index", compact("title","isAdmin"));
    }
    public function userDataAjax()
    {
        
        $columns = array(
            "email","firstname","lastname","address","id"
        );
        $user = $this->accountRepository->getRawUser($columns);
        
        return DataTable::of($user)->filter(function($builder){

            $isAdmin = $this->request->getVar("is_admin");
            if(!is_null($isAdmin) && $isAdmin){
                $builder->where('isAdmin', true);
            }else{
                $builder->where('isAdmin', false);
            }
        })->add("name", function($col){
            return $col->firstname . " " . $col->lastname;
        })->add('action', function ($row) {
            return '
                
                <div class="d-flex">
                    <a href="'.base_url("admin/user/" .$row->id).'" class="btn btn-secondary btn-sm mx-2"><i class="fas fa-eye"></i></a>
                    <form action="'. base_url("admin/user/" . $row->id) .'" method="POST">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </form>
                </div>

            ';
        })->toJson(true);

    }
    public function detail(string $id)
    {
        $title = "Admin Detail Account";
        $user = $this->accountRepository->getUserByID($id);

        if(count($user) < 1)
        {
            return redirect()->to(base_url("/admin/users"));
        }
        $user = $user[0];

        return view("admin/user/detail", compact("title","user"));
    }
    public function destroy(string $id)
    {
        $user = $this->accountRepository->getUserByID($id, array("id","isAdmin"));
        $currentUser = session()->current_user;

        if(count($user) < 1)
        {
            return redirect()->to(base_url("/admin/users"))->with("error" ,"user tidak ditemukan");
        }

        $user = $user[0];
        $currentUser = $currentUser[0];
        $base_url = $user->isAdmin ? "/admin/users?is_admin=" . true : "/admin/users";

        if($user->id == $currentUser->id){
            return redirect()->to(base_url($base_url))->with("error" ,"user tidak dapat dihapus");
        }


        $result = $this->accountRepository->delete($id);

        if(!$result)
        {
            return redirect()->to(base_url($base_url))->with("error" ,"terjadi kesalahan");
        }
        return redirect()->to(base_url($base_url))->with("success" ,"berhasil menghapus akun");

    }
    public function create()
    {
        $title = "Admin Tambah Pengguna";
        helper("form");
        return view("admin/user/add", compact("title"));
    }
    public function store()

    {
        $rules = array(
            "email" => array("required", "valid_email", "is_unique[account.email]"),
            "firstname" => array("required"),
            "password" => array("required", "min_length[8]")
        );


        if (!$this->validate($rules)) {
            helper("form");
            $validation = $this->validator;
            $title = "Admin Tambah Pengguna";
            return view("admin/user/add", compact("validation","title"));
        }

        $data = array(
            "firstname" => $this->request->getVar("firstname"),
            "lastname" => $this->request->getVar("lastname"),
            "email" => $this->request->getVar("email"),
            "password" => password_hash($this->request->getVar("password"),PASSWORD_BCRYPT),
            "isAdmin" => true
        );

        $userModel = new Account();
        $result = $userModel->insert($data);

        if(!$result) {
            return redirect()->to(base_url("/admin/users?is_admin=". true))->with("error", "terjadi kesalahan");
        }

        return redirect()->to(base_url("/admin/users?is_admin=" . true))->with("success", "berhasil menambahkan admin");

    }
}
