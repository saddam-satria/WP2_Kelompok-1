<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Repositories\PackageRepository;
use Hermawan\DataTables\DataTable;

class PackageController extends BaseController
{
    private $packageRepository;

    public function __construct()
    {
     $this->packageRepository= new PackageRepository();   
    }
    public function index()
    {
        $title = "Admin Data Paket Cucian";
        return view("admin/package/index", compact("title"));
    }
    public function packageAjax()
    {
        
        $columns = array("packageID","packageName","packagePrice");
        $packages = $this->packageRepository->getRawPackages($columns);

        return DataTable::of($packages)->format("packagePrice", function($row) {
            return "Rp. " . number_format($row,0,".",".");
        })->add('action', function ($row) {
            return '
                
                <div class="d-flex">
                    <a href="'.base_url("admin/package/edit/" .$row->packageID).'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                    <a href="'.base_url("admin/package/" .$row->packageID).'" class="btn btn-secondary btn-sm mx-2"><i class="fas fa-eye"></i></a>
                    <form action="'. base_url("admin/package/" . $row->packageID) .'" method="POST">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </form>
                </div>

            ';
        })->toJson(true);
    }
    public function store()
    {
        $rules = array(
            "packageName" => array("required"),
            "packagePrice" => array("required", "numeric")
        );
        $messages = array(
            "packageName" => array(
                "required" =>  "kolom nama paket harus diisi"
            ),
            "packagePrice" => array(
                "required" => "kolom harga paket harus diisi",
                "numeric" => "kolom harga paket harus angka"
            )
        );


        if (!$this->validate($rules, $messages)) {
            helper("form");
            $validation = $this->validator;
            $messages = join(", ", $validation->getErrors());

            return redirect()->to(base_url("admin/packages"))->with("error", $messages);
        }

        
        $data = array(
            "packageName" => $this->request->getVar("packageName"),
            "packagePrice" => $this->request->getVar("packagePrice")
        );

        $result = $this->packageRepository->insert($data);

        if(!$result) {
            return redirect()->to(base_url("admin/packages"))->with("error", "terjadi kesalahan");
        }
        return redirect()->to(base_url("admin/packages"))->with("success", "berhasil menyimpan paket cucian");
        
    }
}
