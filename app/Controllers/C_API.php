<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Produk;
use App\Libraries\MakeQRcode;

class C_API extends Controller
{
    public function __construct()
    {
        $this->models = new M_Produk;
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {

        $id = esc($this->request->getVar("enc"));

        // Validate only hexadecimal and even length
        if (!ctype_xdigit($id) || strlen($id) % 2 !== 0) {
            $res = [
                "code" => 400,
                "message" => "Kode QR Tidak Valid"
            ];
            return $this->response->setJSON($res);
        }

        $_init = new MakeQRcode();

        $decrypted = $_init->decrypt($id);

        $data =  $this->models->getDataDecrypted($decrypted);

        if ($data != null) {
            $res = [
                "code" => 200,
                "message" => "Data Original",
                "data" => $data
            ];
        } else {
            $res = [
                "code" => 200,
                "message" => "Data Tidak Original",
            ];
        }

        return $this->response->setJSON($res);
    }
}
