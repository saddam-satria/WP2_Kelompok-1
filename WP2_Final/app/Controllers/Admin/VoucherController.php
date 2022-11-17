<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Repositories\VoucherRepository;
use Hermawan\DataTables\DataTable;

class VoucherController extends BaseController
{
    private $voucherRepository;
    public function __construct()
    {
        $this->voucherRepository = new VoucherRepository();
    }
    public function index()
    {
        $title = "Admin Data Voucher";
        return view("admin/voucher/index", compact("title"));
    }
    public function voucherAjax()
    {
        $columns = array("discount",  "expire", "voucherCode", "voucherID", "isPercentage");
        $voucherQuery = $this->voucherRepository->getRawVoucher($columns);


        return DataTable::of($voucherQuery)->edit("discount", function ($row) {
            return $row->isPercentage ? $row->discount . " %" : "Rp. " .  number_format($row->discount, 0, ".", ".");
        })->add('action', function ($row) {
            return '
                
                <div class="d-flex">
                    <form action="' . base_url("admin/voucher/" . $row->voucherID) . '" method="POST">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </form>
                </div>

            ';
        })->toJson(true);
    }
    public function destroy(string $id)
    {
        $result = $this->voucherRepository->delete($id);

        if (!$result) {
            return redirect()->to(base_url("admin/vouchers"))->with("error",  "terjadi kesalahan");
        }

        return redirect()->to(base_url("admin/vouchers"))->with("success",  "berhasil menghapus voucher");
    }
    public function store()
    {

        $rules = array(
            "discount" => array("required"),
            "expire" => array("required")
        );

        $messages = array(
            "discount" => array(
                "required" =>  "kolom nama servis harus diisi",
            ),
            "expire" => array(
                "required" => "kolom harga servis harus diisi",
            ),
        );

        if (!$this->validate($rules, $messages)) {
            $validation = $this->validator;
            $messages = join(", ", $validation->getErrors());

            return redirect()->to(base_url("admin/vouchers"))->with("error", $messages);
        }




        $data = array(
            "discount" => $this->request->getVar("discount"),
            "isPercentage" => $this->request->getVar("isPercentage") == "on",
            "expire" => $this->request->getVar("expire"),
        );


        $result = $this->voucherRepository->insert($data);

        if (!$result) {
            return redirect()->to(base_url("admin/vouchers"))->with("error",  "terjadi kesalahan");
        }

        return redirect()->to(base_url("admin/vouchers"))->with("success",  "berhasil menambahkan voucher");
    }
}
