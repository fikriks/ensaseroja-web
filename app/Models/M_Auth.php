<?php 

namespace App\Models;

use CodeIgniter\Model;

class M_Auth extends Model{
    // Nama tabel database yang digunakan untuk autentikasi
    protected $table='tb_admin';

    // Konstruktor untuk inisialisasi koneksi database dan query builder
    public function __construct(){
       $this->db = db_connect();          // Membuat koneksi ke database
       $this->builder=$this->db->table($this->table); // Inisialisasi query builder untuk tabel
    }

    /**
     * Fungsi untuk proses login user
     * @param string $username - Username yang dimasukkan
     * @param string $password - Password yang dimasukkan
     * @return bool - Mengembalikan true jika login berhasil, false jika gagal
     */
    public function login($username, $password){
        // Mencari data user berdasarkan username
        $data = $this->builder->where("username", $username)->get()->getRowArray();

        if($data !== null){
            // Memeriksa kecocokan password
        	if($data['password'] == $password){
                // Jika password cocok, set session data
	        	session()->set([
	        		'id' => $data['id'],         // Menyimpan ID user ke session
	        		'username' => $data['username'], // Menyimpan username ke session
	        	]);

	        	return true;  // Login berhasil
        	}else{
                // Jika password salah, set flashdata warning
        		session()->setFlashdata('warning', 'Password salah');
        		return false; // Login gagal
        	}
        }else{
            // Jika username tidak ditemukan, set flashdata warning
        	session()->setFlashdata('warning', 'Password salah');
        	return false; // Login gagal
        }
    }
}