<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Produksi extends Model{
    // Nama tabel utama untuk data produksi
    protected $table='tb_produksi';
    // Nama tabel produk yang terkait
    protected $table_produk = "tb_produk";

    // Konstruktor untuk inisialisasi koneksi database
    public function __construct() //memanggil koneksi
    {
       $this->db = db_connect(); // Membuat koneksi ke database
       $this->builder=$this->db->table($this->table); // Query builder untuk tabel produksi
       $this->builder_produk=$this->db->table($this->table_produk); // Query builder untuk tabel produk
    }

    /**
     * Mengambil semua data produksi
     * @return object - Hasil query semua data produksi
     */
    public function getAlldata()
    {
        return $this->builder->get();
    }

    /**
     * Mengambil data produksi berdasarkan ID
     * @param int $id - ID produksi yang dicari
     * @return array - Data produksi dalam bentuk array
     */
    public function getDataById($id)
    {
        $this->builder->where('id', $id);
        return $this->builder->get()->getRowArray();
    }

    /**
     * Menambahkan data produksi baru
     * @param array $data - Data produksi yang akan ditambahkan
     * @return bool - True jika berhasil, false jika gagal
     */
    public function tambah($data)
    {
       return $this->builder->insert($data);
        if($success)
        {
            return redirect()->to(base_url('batch'));
        }
    }

    /**
     * Menghapus data produksi berdasarkan ID
     * @param int $id - ID produksi yang akan dihapus
     * @return bool - True jika berhasil, false jika gagal
     */
    public function hapus($id)
    {
       return $this->builder->delete(['id' => $id]);
    }

    /**
     * Mengupdate data produksi
     * @param array $data - Data baru untuk diupdate
     * @param int $id - ID produksi yang akan diupdate
     * @return bool - True jika berhasil, false jika gagal
     */
    public function ubah($data, $id)
    {
        return $this->builder->update($data,['id'=>$id]);
    }

    /**
     * Mengupdate tanggal produksi dan expire
     * @param int $id - ID produksi
     * @param string $tgl_produksi - Tanggal produksi baru
     * @param string $tgl_expire - Tanggal expire baru
     * @return bool - True jika berhasil, false jika gagal
     */
    public function updateTgl($id, $tgl_produksi, $tgl_expire){
        return $this->builder_produk->update(['tgl_produksi' => $tgl_produksi, 'tgl_expire' => $tgl_expire], ['id' => $id]);
    }

    /**
     * Mengambil data dengan join antara tabel produk dan produksi
     * @return object - Hasil query join antara tabel produk dan produksi
     */
    function getAllJoinTable(){
        return $this->builder_produk->join("tb_produksi", "tb_produksi.id_produk = tb_produk.id")->get();
    }
}