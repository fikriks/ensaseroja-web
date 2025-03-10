<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Produk;

class Produk extends Controller
{
    // Constructor untuk inisialisasi dan pengecekan session
    public function __construct()
    {
        // Cek apakah session 'username' ada (pengguna sudah login)
        if (session()->get("username") == null) {
            // Jika tidak ada, redirect ke halaman login (base URL)
            return redirect()->to(base_url(""));
        }

        // Inisialisasi model M_Produk
        $this->models = new M_Produk;
    }

    /**
     * Menampilkan halaman data produk.
     * 
     * @return void
     */
    public function index()
    {
        // Data yang akan dikirim ke view
        $data = [
            'judul' => 'Data Produk', // Judul halaman
            'produk' => $this->models->getAllData() // Data produk dari model M_Produk
        ];

        // Menampilkan view dengan template
        echo view('templates/v_header', $data); // Header
        echo view('templates/v_sidebar'); // Sidebar
        echo view('templates/v_topbar'); // Topbar
        echo view('produk/index', $data); // Konten utama data produk
        echo view('templates/v_footer'); // Footer
    }

    /**
     * Menambahkan data produk baru.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function tambah()
    {
        // Cek apakah form tambah dikirim
        if (isset($_POST['tambah'])) {
            // Validasi input form
            $val = $this->validate([
                'kode' => [
                    'label' => 'Kode Produk',
                    'rules' => 'required|is_unique[tb_produk.kode_produk]' // Wajib diisi dan unik
                ],
                'nama' => [
                    'label' => 'Nama Produk',
                    'rules' => 'required' // Wajib diisi
                ],
                'komposisi' => [
                    'label' => 'Komposisi Produk',
                    'rules' => 'required' // Wajib diisi
                ],
                'file' => [
                    'rules' => 'uploaded[file]|mime_in[file,image/jpg,image/jpeg,image/gif,image/png]|max_size[file,2048]' // Wajib diunggah, format gambar, dan maksimal 2MB
                ],
                'No_PIR-T' => [
                    'label' => 'No PIR-T',
                    'rules' => 'required' // Wajib diisi
                ],
                'prod' => [
                    'label' => 'Produsen',
                    'rules' => 'required' // Wajib diisi
                ]
            ]);

            // Jika validasi gagal, tampilkan pesan error
            if (!$val) {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('produk'));
            } else {
                // Proses upload file foto
                $avatar = $this->request->getFile('file');
                $newName = $avatar->getRandomName(); // Generate nama file acak
                $avatar->move(ROOTPATH . "public/foto_product", $newName); // Pindahkan file ke folder tujuan

                // Data yang akan disimpan ke database
                $data = [
                    'kode_produk' => $this->request->getPost('kode'),
                    'nama' => $this->request->getPost('nama'),
                    'foto' => $newName, // Nama file foto
                    'komposisi' => $this->request->getPost('komposisi'),
                    'no_pirt' => $this->request->getPost('No_PIR-T'),
                    'produsen' => $this->request->getPost('prod')
                ];

                // Menyimpan data ke database
                $success = $this->models->tambah($data);
                if ($success) {
                    session()->setFlashdata('message', 'Ditambahkan'); // Pesan sukses
                    return redirect()->to(base_url('produk'));
                } else {
                    session()->setFlashdata('err', 'Gagal Diubah'); // Pesan error
                    return redirect()->to(base_url('produk'));
                }
            }
        } else {
            // Jika form tidak dikirim, redirect ke halaman produk
            return redirect()->to(base_url('produk'));
        }
    }

    /**
     * Menghapus data produk berdasarkan ID.
     * 
     * @param int $id ID produk
     * @param string $path_photo Path folder foto
     * @param string $file Nama file foto
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function hapus($id, $file)
    {
        $rootPath = ROOTPATH . "public/foto_product/"; // Path folder foto
        $success = $this->models->hapus($id); // Menghapus data dari database

        // Jika penghapusan berhasil
        if ($success) {
            session()->setFlashdata('message', 'Dihapus'); // Pesan sukses

            // Hapus file foto dan folder terkait
            unlink($rootPath . "/" . $file); // Hapus file foto
            return redirect()->to(base_url('produk'));
        } else {
            session()->setFlashdata('err', 'Gagal Dihapus'); // Pesan error
            return redirect()->to(base_url('produk'));
        }
    }

    /**
     * Mengubah data produk.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function ubah()
    {
        // Cek apakah form ubah dikirim
        if (isset($_POST['ubah'])) {
            $id = $this->request->getPost('id'); // Ambil ID produk
            $kode = $this->request->getPost('kode'); // Ambil kode produk dari form
            $db_kode = $this->models->getDataById($id)['kode_produk']; // Ambil kode produk dari database

            // Jika kode produk tidak berubah
            if ($kode === $db_kode) {
                $val = $this->validate([
                    'kode' => [
                        'label' => 'Kode Produk',
                        'rules' => 'required' // Wajib diisi
                    ],
                    'nama' => [
                        'label' => 'Nama Produk',
                        'rules' => 'required' // Wajib diisi
                    ],
                    'komposisi' => [
                        'label' => 'Komposisi Produk',
                        'rules' => 'required' // Wajib diisi
                    ],
                    'No_PIR-T' => [
                        'label' => 'Ijin Produk',
                        'rules' => 'required' // Wajib diisi
                    ],
                    'prod' => [
                        'label' => 'Produsen',
                        'rules' => 'required' // Wajib diisi
                    ]
                ]);
            } else {
                // Jika kode produk berubah, validasi kode harus unik
                $val = $this->validate([
                    'kode' => [
                        'label' => 'Kode Produk',
                        'rules' => 'required|is_unique[tb_produk.kode_produk]' // Wajib diisi dan unik
                    ],
                    'nama' => [
                        'label' => 'Nama Produk',
                        'rules' => 'required' // Wajib diisi
                    ],
                    'komposisi' => [
                        'label' => 'Komposisi Produk',
                        'rules' => 'required' // Wajib diisi
                    ],
                    'No_PIR-T' => [
                        'label' => 'Ijin Produk',
                        'rules' => 'required' // Wajib diisi
                    ],
                    'prod' => [
                        'label' => 'Produsen',
                        'rules' => 'required' // Wajib diisi
                    ]
                ]);
            }

            // Jika validasi gagal, tampilkan pesan error
            if (!$val) {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('produk'));
            } else {
                $id = $this->request->getPost('id'); // Ambil ID produk
                $avatar = $this->request->getFile('file'); // Ambil file foto dari form

                // Jika ada file baru yang diunggah
                if ($avatar->getName() != "") {
                    $newName = $avatar->getRandomName(); // Generate nama file acak
                    $avatar->move(ROOTPATH . "public/foto_product", $newName); // Pindahkan file ke folder tujuan

                    // Data yang akan diupdate
                    $data = [
                        'kode_produk' => $this->request->getPost('kode'),
                        'nama' => $this->request->getPost('nama'),
                        'foto' => $newName, // Nama file baru
                        'komposisi' => $this->request->getPost('komposisi'),
                        'no_pirt' => $this->request->getPost('No_PIR-T'),
                        'produsen' => $this->request->getPost('prod')
                    ];

                    // Update data ke database
                    $success = $this->models->ubah($data, $id);
                    if ($success) {
                        session()->setFlashdata('message', 'Diubah'); // Pesan sukses
                        return redirect()->to(base_url('produk'));
                    } else {
                        session()->setFlashdata('err', 'Gagal Diubah'); // Pesan error
                        return redirect()->to(base_url('produk'));
                    }
                } else {
                    // Jika tidak ada file baru yang diunggah
                    $data = [
                        'kode_produk' => $this->request->getPost('kode'),
                        'nama' => $this->request->getPost('nama'),
                        'komposisi' => $this->request->getPost('komposisi'),
                        'no_pirt' => $this->request->getPost('No_PIR-T'),
                        'produsen' => $this->request->getPost('prod')
                    ];

                    // Update data ke database
                    $success = $this->models->ubah($data, $id);
                    if ($success) {
                        session()->setFlashdata('message', 'Diubah'); // Pesan sukses
                        return redirect()->to(base_url('produk'));
                    } else {
                        session()->setFlashdata('err', 'Gagal Diubah'); // Pesan error
                        return redirect()->to(base_url('produk'));
                    }
                }
            }
        } else {
            // Jika form tidak dikirim, redirect ke halaman produk
            return redirect()->to(base_url('produk'));
        }
    }
}