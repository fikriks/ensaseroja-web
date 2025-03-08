<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Produksi extends Model{

    protected $table='tb_produksi';
    protected $table_produk = "tb_produk";

    public function __construct() //memanggil koneksi
    {
       $this->db = db_connect();
       $this->builder=$this->db->table($this->table);
       $this->builder_produk=$this->db->table($this->table_produk);
    }
    public function getAlldata()
    {
        return $this->builder->get();
    }

    public function getDataById($id)
    {
        $this->builder_produk->where('id', $id);
        return $this->builder->get()->getRowArray();
    }

    public function tambah($data)
    {
       return $this->builder->insert($data);
        if($success)
        {
            return redirect()->to(base_url('batch'));
        }
    }

    public function hapus($id)
    {
       return $this->builder->delete(['id' => $id]);
    }

    public function ubah($data, $id)
    {
        return $this->builder->update($data,['id'=>$id]);
    }

    public function updateTgl($id, $tgl_produksi, $tgl_expire){
        return $this->builder_produk->update(['tgl_produksi' => $tgl_produksi, 'tgl_expire' => $tgl_expire], ['id' => $id]);
    }


    // JOIN TABLE

    function getAllJoinTable(){
        return $this->builder_produk->join("tb_produksi", "tb_produksi.id_produk = tb_produk.id")->get();
    }

}