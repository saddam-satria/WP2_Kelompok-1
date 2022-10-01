<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MatakuliahController extends BaseController
{

    public function create()
    {
        return view("matakuliah/form");
    }
    public function store()
    {
        $data = array(
            "kode" => $this->request->getVar("kode"),
            "nama" => $this->request->getVar("nama"),
            "sks" => $this->request->getVar("sks"),
        );

        return view("matakuliah/index", compact("data"));
    }
}
