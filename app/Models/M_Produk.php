<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Produk extends Model{
    // Nama tabel utama untuk produk
    protected $table='tb_produk';
    // Nama tabel batch produksi
    protected $table_bacth='tb_produksi';

    // Konstruktor untuk inisialisasi koneksi database
    public function __construct() //memanggil koneksi
    {
       $this->db = db_connect(); // Membuat koneksi database
       $this->builder = $this->db->table($this->table); // Query builder untuk tabel produk
       $this->builder_batch = $this->db->table($this->table_bacth); // Query builder untuk tabel produksi
    }

    /**
     * Mengambil semua data produk
     * @return object - Hasil query semua data produk
     */
    public function getAlldata()
    {
        return $this->builder->get();
    }

    /**
     * Mengambil data produk berdasarkan ID
     * @param int $id - ID produk yang dicari
     * @return array - Data produk dalam bentuk array
     */
    public function getDataById($id)
    {
        $this->builder->where('id', $id);
        return $this->builder->get()->getRowArray();
    }

    /**
     * Menambahkan data produk baru
     * @param array $data - Data produk yang akan ditambahkan
     * @return bool - True jika berhasil, false jika gagal
     */
    public function tambah($data)
    {
       return $this->builder->insert($data);
    }

    /**
     * Menghapus data produk berdasarkan ID
     * @param int $id - ID produk yang akan dihapus
     * @return bool - True jika berhasil, false jika gagal
     */
    public function hapus($id)
    {
       return $this->builder->delete(['id' => $id]);
    }

    /**
     * Mengupdate data produk
     * @param array $data - Data baru untuk diupdate
     * @param int $id - ID produk yang akan diupdate
     * @return bool - True jika berhasil, false jika gagal
     */
    public function ubah($data, $id)
    {
        return $this->builder->update($data,['id'=>$id]);
    }

    /**
     * Mengambil data produk berdasarkan ID dalam bentuk array
     * @param int $id - ID produk yang dicari
     * @return array - Hasil query dalam bentuk array
     */
    public function getDataByIdArr($id)
    {
        // *Pake yg ini ya*
        // return $this->builder_batch->join("tb_produk", "tb_produk.id = tb_produksi.id_produk", 'inner')->where('tb_produk.id', $id)->get()->getResultArray();
        // *End pake yg ini ya*
        
        return $this->builder->where('id', $id)->get()->getResultArray();
    }
    
    /**
     * Mengambil data produk yang terenkripsi berdasarkan kode
     * @param string $kode - Kode enkripsi produk
     * @return array - Data produk yang sudah didekripsi
     */
    function getDataDecrypted($kode){
        // Mencari data batch produksi berdasarkan kode
        $data = $this->builder_batch->where(["kode" => $kode])->get()->getResultArray();
        
        // Mengambil informasi penting dari data batch
        $id_produk = $data[0]['id_produk'];
        $tgl_produksi = $data[0]['tgl_produksi'];
        $tgl_expire = $data[0]['tgl_expire'];
        
        // Mengambil data produk dengan join ke tabel batch produksi
        return $this->builder_batch->join("tb_produk", "tb_produk.id = tb_produksi.id_produk", 'inner')
            ->where([
                'tb_produk.id' =>$id_produk, 
                "tb_produksi.tgl_produksi" => $tgl_produksi, 
                "tb_produksi.tgl_expire" => $tgl_expire
            ])
            ->get()
            ->getResultArray();
    }
}