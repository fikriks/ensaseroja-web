<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Produk extends Model{
    protected $table='tb_produk';
    protected $table_bacth='tb_produksi';

    public function __construct() //memanggil koneksi
    {
       $this->db = db_connect();
       $this->builder = $this->db->table($this->table);
       $this->builder_batch = $this->db->table($this->table_bacth);
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

    public function tambah($data)
    {
       return $this->builder->insert($data);
    }

    public function hapus($id)
    {
       return $this->builder->delete(['id' => $id]);
    }

    public function ubah($data, $id)
    {
        return $this->builder->update($data,['id'=>$id]);
    }

    public function getDataByIdArr($id)
    {
        // *Pake yg ini ya*
        // return $this->builder_batch->join("tb_produk", "tb_produk.id = tb_produksi.id_produk", 'inner')->where('tb_produk.id', $id)->get()->getResultArray();
        // *End pake yg ini ya*
        
        return $this->builder->where('id', $id)->get()->getResultArray();
        
        
        //  return $this->builder_batch->join("tb_produk", "tb_produk.id = tb_produksi.id_produk", 'inner')->get()->getResultArray();
        // $this->builder->where('id', $id);
        // return $this->builder->get()->getResultArray();
        // $db = $this->db;
        // $builder = $db->table("tb_produk");
        // $builder->select("*");
        // $builder->join("tb_produksi", "tb_produksi.id = tb_produk.id");
        // // $builder->where("id_produk", $id);
        // return $builder->get()->getResultArray();

    }
    
    function getDataDecrypted($kode){
        $data = $this->builder_batch->where(["kode" => $kode])->get()->getResultArray();
        
        $id_produk = $data[0]['id_produk'];
        $tgl_produksi = $data[0]['tgl_produksi'];
        $tgl_expire = $data[0]['tgl_expire'];
        
        return $this->builder_batch->join("tb_produk", "tb_produk.id = tb_produksi.id_produk", 'inner')->where(['tb_produk.id' =>$id_produk, "tb_produksi.tgl_produksi" => $tgl_produksi, "tb_produksi.tgl_expire" => $tgl_expire])->get()->getResultArray();
    }
}