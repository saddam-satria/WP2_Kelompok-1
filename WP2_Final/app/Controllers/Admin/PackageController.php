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
                    <a href="'.base_url("admin/package/edit/" .$row->packageID).'" class="btn btn-primary btn-sm mr-3"><i class="fas fa-edit"></i></a>
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
            "packageName" => array("required","is_unique[package.packageName]"),
            "packagePrice" => array("required", "numeric")
        );
        $messages = array(
            "packageName" => array(
                "required" =>  "kolom nama paket harus diisi",
                "is_unique" => "kolom nama sudah ada"
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
    public function destroy(string $id)
    {
        try {
            $this->packageRepository->delete($id);
        } catch (\Throwable $th) {
            return redirect()->to(base_url("admin/packages"))->with("error", "orderan sedang tidak kosong");
        }
        return redirect()->to(base_url("admin/packages"))->with("success", "berhasil menghapus paket cucian");
        

    }
    public function edit(string $id)

    {
        $title = "Admin Edit Paket Cucian";
        $package = $this->packageRepository->getPackageByID($id,array("packageID","packageName","packagePrice"));
        if(count($package) < 1) {
            return redirect()->to(base_url("admin/packages"))->with("error","order tidak ditemukan");
        }
        $package = $package[0];
        return view("admin/package/edit", compact("title","package"));
    }
    public function update(string $id)
    {
        $rules = array(
            "packageName" => array("required","is_unique[package.packageName,packageID,{packageID}]"),
            "packagePrice" => array("required", "numeric")
        );
        $messages = array(
            "packageName" => array(
                "required" =>  "kolom nama paket harus diisi",
                "is_unique" => "kolom nama sudah ada"
            ),
            "packagePrice" => array(
                "required" => "kolom harga paket harus diisi",
                "numeric" => "kolom harga paket harus angka"
            )
        );


        if (!$this->validate($rules, $messages)) {
            $validation = $this->validator;
            $package = $this->packageRepository->getPackageByID($id, array("packageID", "packageName", "packagePrice"))[0];
            return view("admin/package/edit", compact("validation", "package"));
        }


            
        $data = array(
            "packageName" => $this->request->getVar("packageName"),
            "packagePrice" => $this->request->getVar("packagePrice")
        );

        $result = $this->packageRepository->update($id,$data);

        if(!$result) {
            return redirect()->to(base_url("admin/packages"))->with("error", "terjadi kesalahan");
        }
        return redirect()->to(base_url("admin/packages"))->with("success", "berhasil mengupdate paket cucian");
        
    }
}
