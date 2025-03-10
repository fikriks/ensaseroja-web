<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Info;

class Info extends Controller
{
    // Constructor untuk inisialisasi model
    public function __construct()
    {
        // Cek apakah session 'username' ada (pengguna sudah login)
        if (session()->get("username") == null) {
            // Jika tidak ada, redirect ke halaman login (base URL)
            return redirect()->to(base_url(""));
        }
        
        // Inisialisasi model M_Info
        $this->models = new M_Info;
    }

    /**
     * Menampilkan halaman profil perusahaan.
     * 
     * @return void
     */
    public function index()
    {
        // Data yang akan dikirim ke view
        $data = [
            'judul' => 'Profil Perusahaan', // Judul halaman
            'info' => $this->models->getAllData() // Data profil perusahaan dari model M_Info
        ];

        // Menampilkan view dengan template
        echo view('templates/v_header', $data); // Header
        echo view('templates/v_sidebar'); // Sidebar
        echo view('templates/v_topbar'); // Topbar
        echo view('info/index', $data); // Konten utama profil perusahaan
        echo view('templates/v_footer'); // Footer
    }

    /**
     * Mengubah data profil perusahaan.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function ubah()
    {
        // Cek apakah form ubah dikirim
        if (isset($_POST['ubah'])) {
            // Ambil nama file lama dari input hidden
            $file_old = $this->request->getVar("file_old");

            // Validasi input form
            $val = $this->validate([
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required' // Wajib diisi
                ],
                'deskripsi' => [
                    'label' => 'Deskripsi',
                    'rules' => 'required' // Wajib diisi
                ],
            ]);

            // Jika validasi gagal, tampilkan pesan error
            if (!$val) {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('info'));
            } else {
                // Ambil file lama dan file baru dari form
                $file_old = $this->request->getVar('file_old');
                $file_new = $this->request->getFile('file');

                // Jika ada file baru yang diunggah
                if ($file_new->getName() != null) {
                    $id = $this->request->getPost('id'); // Ambil ID dari form
                    $rootPath = "foto_profile_perusahaan/"; // Path untuk menyimpan file

                    // Proses upload file baru
                    $profile = $this->request->getFile('file');
                    $newName = $profile->getRandomName(); // Generate nama file acak
                    $profile->move(ROOTPATH . "public/foto_profile_perusahaan", $newName); // Pindahkan file ke folder tujuan

                    // Data yang akan diupdate
                    $data = [
                        'nama' => $this->request->getPost('nama'),
                        'foto' => $newName, // Gunakan nama file baru
                        'deskripsi' => $this->request->getPost('deskripsi')
                    ];

                    // Update data ke database
                    $success = $this->models->ubah($data, $id);
                    if ($success) {
                        session()->setFlashdata('message', 'Diubah'); // Pesan sukses

                        // Jika ada file lama, hapus file lama
                        if ($file_old != "") {
                            if ($file_old != $newName) {
                                unlink($rootPath . $file_old);
                            }
                        }

                        return redirect()->to(base_url('info'));
                    } else {
                        session()->setFlashdata('err', 'Gagal Diubah'); // Pesan error
                        return redirect()->to(base_url('info'));
                    }
                } else {
                    // Jika tidak ada file baru yang diunggah
                    $id = $this->request->getPost('id');

                    // Data yang akan diupdate (tanpa mengubah foto)
                    $data = [
                        'nama' => $this->request->getPost('nama'),
                        'deskripsi' => $this->request->getPost('deskripsi')
                    ];

                    // Update data ke database
                    $success = $this->models->ubah($data, $id);
                    if ($success) {
                        session()->setFlashdata('message', 'Diubah'); // Pesan sukses
                        return redirect()->to(base_url('info'));
                    } else {
                        session()->setFlashdata('err', 'Gagal Diubah'); // Pesan error
                        return redirect()->to(base_url('info'));
                    }
                }
            }
        } else {
            // Jika form tidak dikirim, redirect ke halaman info
            return redirect()->to(base_url('info'));
        }
    }
}