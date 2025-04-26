<?php

namespace App\Controllers;

use App\Models\M_Produk;
use App\Models\M_Produksi;

class Home extends BaseController
{
    /**
     * Constructor untuk inisialisasi dan pengecekan session.
     */
    public function __construct()
    {
        // Cek apakah session 'username' ada (pengguna sudah login)
        if (session()->get("username") == null) {
            // Jika tidak ada, redirect ke halaman login (base URL)
            return redirect()->to(base_url(""));
        }
    }

    /**
     * Menampilkan halaman dashboard.
     * 
     * @return void
     */
    public function index()
    {
        // Inisialisasi model M_Produk dan M_Produksi
        $dataProduct = new M_Produk;
        $dataBatch = new M_Produksi;

        // Data yang akan dikirim ke view
        $data = [
            'judul' => 'Dashboard', // Judul halaman
            'produk' => $dataProduct->getAllData(), // Data produk dari model M_Produk
            'batch' => $dataBatch->getAllData() // Data batch dari model M_Produksi
        ];

        // Menampilkan view dengan template
        return view('dashboard/index', $data);
    }
}
