<?php

namespace App\Controllers;

use App\Models\M_Auth;

class Auth extends BaseController
{
    /**
     * Menampilkan halaman login.
     * 
     * @return void
     */
    public function index()
    {
        // Data yang akan dikirim ke view
        $data = [
            'judul' => "Login sistem" // Judul halaman login
        ];

        // Menampilkan view 'auth/index' dengan data yang telah disiapkan
        echo view('auth/index', $data);
    }

    /**
     * Memproses aksi login.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    function actLogin()
    {
        // Validasi input form
        $val = $this->validate([
            'username' => [
                'label' => 'Username', // Label untuk pesan error
                'rules' => 'required|min_length[4]' // Aturan validasi: wajib diisi dan minimal 4 karakter
            ],
            'password' => [
                'label' => 'Password', // Label untuk pesan error
                'rules' => 'required' // Aturan validasi: wajib diisi
            ],
        ]);

        // Jika validasi berhasil
        if ($val) {
            // Membuat instance dari model M_Auth
            $this->auth = new M_Auth();

            // Mengambil data input dari form
            $username = $this->request->getVar("username"); // Mengambil username
            $passw = $this->request->getVar("password"); // Mengambil password

            // Memanggil method login dari model M_Auth untuk memeriksa kredensial
            if ($this->auth->login($username, $passw)) {
                // Jika login berhasil, redirect ke halaman 'home'
                return redirect()->to(base_url("home"));
            } else {
                // Jika login gagal, redirect kembali ke halaman login
                return redirect()->to(base_url());
            }
        } else {
            // Jika validasi gagal, tampilkan pesan error dan redirect kembali ke halaman login
            session()->setFlashdata('err', \Config\Services::validation()->listErrors());
            return redirect()->to(base_url(''));
        }
    }

    /**
     * Memproses aksi logout.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    function logout()
    {
        // Menghancurkan session (logout)
        session()->destroy();

        // Redirect ke halaman login setelah logout
        return redirect()->to(base_url());
    }
}
