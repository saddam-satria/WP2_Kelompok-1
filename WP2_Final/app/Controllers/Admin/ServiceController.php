<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Repositories\ServiceRepository;
use Hermawan\DataTables\DataTable;

class ServiceController extends BaseController
{
    private $serviceRepository;

    public function __construct()
    {
        $this->serviceRepository = new ServiceRepository();
    }
    public function index()
    {
        $title = "Admin Data Servis Laundry";
        return view("admin/service/index", compact("title"));
    }
    public function serviceAjax()
    {
        $columns = array("serviceID","serviceName","servicePrice");
        return DataTable::of($this->serviceRepository->getRawServices($columns))->add('action', function ($row) {
            return '
                
                <div class="d-flex">
                    <a href="'.base_url("admin/service/edit/" .$row->serviceID).'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                    <a href="'.base_url("admin/service/" .$row->serviceID).'" class="btn btn-secondary btn-sm mx-2"><i class="fas fa-eye"></i></a>
                    <form action="'. base_url("admin/service/" . $row->serviceID) .'" method="POST">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </form>
                </div>

            ';
        })->format("servicePrice", function($data){
            return number_format($data,0,".",".");
        })->toJson(true);
    }
    public function store()
    {
        $rules = array(
            "serviceName" => array("required"),
            "servicePrice" => array("required", "numeric"),
            "serviceLogo" => array("max_size[serviceLogo,2048]","mime_in[serviceLogo,image/png,image/jpg,image/jpeg,image/svg]","ext_in[serviceLogo,png,jpg,jpeg,svg]", "is_image[serviceLogo]")
        );
        $messages = array(
            "serviceName" => array(
                "required" =>  "kolom nama servis harus diisi"
            ),
            "servicePrice" => array(
                "required" => "kolom harga servis harus diisi",
                "numeric" => "kolom harga servis harus angka"
            ),
            "serviceLogo" => array(
                "max_size" => "file terlalu besar max 2mb",
                "mime_in" => "file harus berupa gambar",
                "ext_in" => "file harus berupa gambar",
                "is_image" => "file harus berupa gambar",
            )
        );


        if (!$this->validate($rules, $messages)) {
            helper("form");
            $validation = $this->validator;
            $messages = join(", ", $validation->getErrors());

            return redirect()->to(base_url("admin/services"))->with("error", $messages);
        }

        $image = $this->request->getFile("serviceLogo");

        $fileName = $image->getRandomName();

        $image->move("assets/img/services", $fileName,true);


        $data = array(
            "serviceName" => $this->request->getVar("serviceName"),
            "servicePrice" => $this->request->getVar("servicePrice"),
            "serviceLogo" => "services/" . $fileName
        );


        $result = $this->serviceRepository->insert($data);

        if(!$result){
            return redirect()->to(base_url("admin/services"))->with("error", "terjadi kesalahan");
        }
        return redirect()->to(base_url("admin/services"))->with("success", "berhasil disimpan");
    }
    public function detail(string $id)
    {
        $title =  "Admin Data Detail Servis";

        $service = $this->serviceRepository->getServiceByID($id,array("serviceID","serviceName","serviceLogo","servicePrice"));
       
        if(count($service) < 1){    
            return redirect()->to(base_url("admin/services"))->with("error", "servis tidak ditemukan");
        }
        $service = $service[0];
        return view("admin/service/detail", compact("title", "service"));
    }
    public function destroy(string $id)
    {

        $service = $this->serviceRepository->getServiceByID($id,array("serviceID","serviceLogo"));
        
        if(count($service) < 1){
            return redirect()->to(base_url("admin/services"))->with("error", "servis tidak ditemukan");
        }

        $service=$service[0];
        $prevImage = $service->serviceLogo;

        
        $this->serviceRepository->delete($service->serviceID);
        
        if(!is_null($prevImage))
        {
            $completePath = FCPATH . "assets/img/" . $prevImage;
            unlink($completePath);
        }
        
        return redirect()->to(base_url("admin/services"))->with("success", "berhasil menghapus servis");


    }
}
