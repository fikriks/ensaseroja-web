<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Info extends Model{
    protected $table='tb_profil';

    public function __construct() //memanggil koneksi
    {
       $this->db = db_connect();
       $this->builder=$this->db->table($this->table);
    }

    public function getAlldata()
    {
        return $this->builder->get();
    }

    public function getDataById($id)
    {
        $this->builder->where('id', $id);
        return $this->builder->get()->getRowArray();
    }
    
    public function ubah($data, $id)
    {
        return $this->builder->update($data,['id'=>$id]);
    }

}

