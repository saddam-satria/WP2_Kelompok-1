<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Repositories\ItemRepository;
use Hermawan\DataTables\DataTable;

class ItemController extends BaseController
{
    private $itemRepository;
    public function __construct()
    {
        $this->itemRepository = new ItemRepository();
    }
    public function index()
    {
        $title = "Admin Data Pakaian";
        return view("admin/item/index",compact("title"));
    }
    public function itemAjax()
    {
        $columns = array("itemID","itemName","itemPrice","quantityPerKG", "isSneaker");
        return DataTable::of($this->itemRepository->getRawItems($columns))->format("itemPrice", function($row){
            return number_format($row,0,".",".");
        })->format("quantityPerKG", function($row){
            return $row . " pcs";
        })->add('action', function ($row) {
            return '
                
                <div class="d-flex">
                    <a href="'.base_url("admin/item/edit/" .$row->itemID).'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                    <a href="'.base_url("admin/item/" .$row->itemID).'" class="btn btn-secondary btn-sm mx-2"><i class="fas fa-eye"></i></a>
                    <form action="'. base_url("admin/item/" . $row->itemID) .'" method="POST">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </form>
                </div>

            ';
        })->toJson(true);

    }
    public function detail(string $id)
    {
        $title = "Admin Detail Jenis Pakaian";
        $item = $this->itemRepository->getItemByID($id,array("itemID","itemName","itemPrice","quantityPerKG","itemLogo"));
        if(count($item) < 1){
            return redirect()->to(base_url("admin/items"))->with("error","jenis pakaian tidak ditemukan");
        }
        $item= $item[0];
        return view("admin/item/detail", compact("title","item"));
    }
    public function store(){


        $rules = array(
            "itemName" => array("required"),
            "itemPrice" => array("required", "numeric"),
            "quantityPerKG" => array("required", "numeric"),
            "itemLogo" => array("max_size[itemLogo,2048]","mime_in[itemLogo,image/png,image/jpg,image/jpeg,image/svg]","ext_in[itemLogo,png,jpg,jpeg,svg]", "is_image[itemLogo]")
        );
        $messages = array(
            "itemName" => array(
                "required" =>  "kolom jenis pakaian harus diisi"
            ),
            "itemPrice" => array(
                "required" => "kolom harga per kg harus diisi",
                "numeric" => "kolom harga per kg harus angka"
            ),
            "quantityPerKG" => array(
                "required" => "kolom jumlah per kg harus diisi",
                "numeric" => "kolom jumlah per kg harus angka"
            ),
            "itemLogo" => array(
                "max_size" => "file terlalu besar max 2mb",
                "mime_in" => "file harus berupa gambar",
                "ext_in" => "file harus berupa gambar",
                "is_image" => "file harus berupa gambar",
            )
        );


        if (!$this->validate($rules, $messages)) {
            $validation = $this->validator;
            $messages = join(", ",$validation->getErrors());

            return redirect()->to(base_url("admin/items"))->with("error", $messages);
        }

        $image = $this->request->getFile("itemLogo");

        $fileName = $image->getRandomName();

        $image->move("assets/img/items", $fileName,true);


        $data = array(
            "itemName" => $this->request->getVar("itemName"),
            "itemPrice" => $this->request->getVar("itemPrice"),
            "quantityPerKG" => $this->request->getVar("quantityPerKG"),
            "isSneaker" => $this->request->getVar("isSneaker") == "on",
            "itemLogo" => "items/" . $fileName
        );


        $result = $this->itemRepository->insert($data);

        if(!$result){
            return redirect()->to(base_url("admin/items"))->with("error", "terjadi kesalahan");
        }
        return redirect()->to(base_url("admin/items"))->with("error", "berhasil disimpan");
 
    }
}
