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
}
