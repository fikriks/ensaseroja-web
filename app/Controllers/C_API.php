<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Produk;
use App\Models\M_Info;
use App\Libraries\MakeQRcode;

class C_API extends Controller
{
    public function __construct()
    {
    	$this->models = new M_Produk;
        $this->info = new M_Info;
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index(){

        $id = esc($this->request->getVar("enc"));

        $_init = new MakeQRcode();

        $decrypted = $_init->decrypt($id);

        $data =  $this->models->getDataDecrypted($decrypted);
        
        if($data != null){
            $res = [
                "code" => 200,
                "message" => "Data Original",
                "data" => $data
            ];
        }else{
            $res = [
                "code" => 200,
                "message" => "Data Tidak Original",
            ];
        }

        return $this->response->setJSON($res);
    }

    function getDataHome(){
        $data =  $this->info->getAlldata();

        if($data->getResultArray() != null){
            $res = [
                "code" => 200,
                "message" => "",
                "data" => $data->getResultArray()
            ];
        }else{
            $res = [
                "code" => 404,
                "message" => "Tidak ada data",
            ];
        }

        return $this->response->setJSON($res);
    }
}
