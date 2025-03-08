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
        echo view('templates/v_header', $data); // Header
        echo view('templates/v_sidebar'); // Sidebar
        echo view('templates/v_topbar'); // Topbar
        echo view('home/index'); // Konten utama dashboard
        echo view('templates/v_dashboard'); // Template khusus dashboard
        echo view('templates/v_footer'); // Footer
    }

    /**
     * Menampilkan halaman informasi profil perusahaan.
     * 
     * @return void
     */
    public function Info()
    {
        // Inisialisasi model M_Info
        $models = new M_Info();

        // Data yang akan dikirim ke view
        $data = [
            'judul' => 'Profil Perusahaan', // Judul halaman
            'info' => $models->getAllData() // Data informasi dari model M_Info
        ];

        // Menampilkan view dengan template
        echo view('templates/v_header', $data); // Header
        echo view('templates/v_sidebar'); // Sidebar
        echo view('templates/v_topbar'); // Topbar
        echo view('info/index', $data); // Konten utama informasi
        echo view('templates/v_footer'); // Footer
    }
}