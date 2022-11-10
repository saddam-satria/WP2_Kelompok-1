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
                    <a href="'.base_url("admin/item/" .$row->serviceID).'" class="btn btn-secondary btn-sm mx-2"><i class="fas fa-eye"></i></a>
                    <form action="'. base_url("admin/service/" . $row->serviceID) .'" method="POST">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </form>
                </div>

            ';
        })->format("servicePrice", function($data){
            return number_format($data,0,".",".");
        })->toJson(true);
    }
}
