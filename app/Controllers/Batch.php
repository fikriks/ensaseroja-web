<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Produksi;
use App\Models\M_Produk;
use App\Libraries\MakeQRcode;

class Batch extends Controller
{
    // Constructor untuk inisialisasi model dan library
    public function __construct()
    {
        // Cek apakah session 'username' ada (pengguna sudah login)
        if (session()->get("username") == null) {
            // Jika tidak ada, redirect ke halaman login (base URL)
            return redirect()->to(base_url(""));
        }

        // Inisialisasi model M_Produksi
        $this->models = new M_Produksi;
        // Inisialisasi model M_Produk
        $this->product = new M_Produk;
    }

    /**
     * Menampilkan halaman utama data produksi.
     * 
     * @return void
     */
    public function index()
    {
        // Data yang akan dikirim ke view
        $data = [
            'batch' => $this->models->getAllData(), // Data produksi dari model M_Produksi
            'produk' => $this->product->getAllData(), // Data produk dari model M_Produk
            'join' => $this->models->getAllJoinTable(), // Data gabungan dari tabel terkait
        ];

        // Menampilkan view dengan template
        return view('batch/index', $data); // Konten utama
    }

    /**
     * Mengembalikan data produk dalam format HTML berdasarkan ID.
     * 
     * @return void
     */
    public function returnJSONENC()
    {
        // Mengambil ID produk dari request
        $id = $this->request->getVar("id");
        // Mengambil data produk berdasarkan ID
        $getData = $this->product->getDataByIdArr($id);
        $output = "";

        // Jika data ditemukan, format data ke dalam HTML
        if ($getData != null) {
            foreach ($getData as $items) {
                $output .= "
                    <div>
                        <img src='" . base_url('foto_product/' . $items['foto']) . "' class='w-100' >
                        <textarea class='form-control' readonly>" . $items['komposisi'] . "</textarea>
                        <input type='text' value='" . $items['No_PIR-T'] . "' class='form-control' readonly >
                        <input type='text' value='" . $items['produsen'] . "' class='form-control' readonly >
                    </div>
                ";
            }
        }
        // Mengembalikan output dalam format HTML
        echo $output;
    }

    /**
     * Menambahkan data produksi baru.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function tambah()
    {
        // Cek apakah form tambah dikirim
        if (isset($_POST['tambah'])) {
            // Validasi input form
            $val = $this->validate([
                'idproduk' => [
                    'label' => 'Kode Produk',
                    'rules' => 'required|min_length[1]|numeric', // Wajib diisi, minimal 1 karakter, dan numerik
                    'errors' => [
                        'numeric' => "Produk tidak boleh kosong"
                    ]
                ],
                'tgl_produksi' => [
                    'label' => "Tanggal Produksi",
                    'rules' => "required", // Wajib diisi
                    'errors' => [
                        'required' => "Tanggal Produksi Tidak Boleh Kosong"
                    ]
                ],
                'tgl_expire' => [
                    'label' => "Tanggal Expire Tidak Boleh Kosong",
                    'rules' => "required", // Wajib diisi
                    'errors' => [
                        'required' => "Tanggal Expire Tidak Boleh Kosong"
                    ]
                ],
                'jml_produksi' => [
                    'label' => "Jumlah produksi Tidak Boleh Kosong",
                    'rules' => "required", // Wajib diisi
                    'errors' => [
                        'required' => "Jumlah produksi Tidak Boleh Kosong"
                    ]
                ]
            ]);

            // Jika validasi gagal, tampilkan pesan error
            if ($val == false) {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('batch'));
            } else {
                // Inisialisasi library MakeQRcode
                $initial_qr = new MakeQRcode();

                $idProduk = $this->request->getPost('idproduk');
                $produk = $this->product->getDataById($idProduk);
                $tglProduksi = date('dmy', strtotime($this->request->getPost("tgl_produksi")));

                // Get the last sequence number for this product and date
                $lastBatch = $this->models->where('id_produk', $idProduk)
                    ->where('DATE(tgl_produksi)', $this->request->getPost("tgl_produksi"))
                    ->orderBy('kode', 'DESC')
                    ->get()->getRowArray();

                // Set starting sequence number
                $startSeq = 1;
                if ($lastBatch) {
                    // Extract the last sequence number from the code
                    $lastSeq = intval(substr($lastBatch['kode'], -3));
                    $startSeq = $lastSeq + 1;
                }

                for ($i = 0; $i < intval($this->request->getPost('jml_produksi')); $i++) {
                    $kode = $produk['kode_produk'] . $tglProduksi . sprintf('%03d', $startSeq + $i);

                    // Data yang akan disimpan ke database
                    $data = [
                        'kode' => $kode,
                        'id_produk' => $this->request->getPost('idproduk'),
                        'tgl_produksi' => $this->request->getPost("tgl_produksi"),
                        'tgl_expire' => $this->request->getPost("tgl_expire"),
                        'qrcode' => $initial_qr->make(rand(10, 10000000) . "_", $kode)
                    ];

                    // Menyimpan data ke database
                    $success = $this->models->tambah($data);
                }

                if ($success) {
                    session()->setFlashdata('message', 'Ditambahkan'); // Pesan sukses
                    return redirect()->to(base_url('batch'));
                } else {
                    session()->setFlashdata('err', 'Gagal Diubah'); // Pesan error
                    return redirect()->to(base_url('batch'));
                }
            }
        } else {
            // Jika form tidak dikirim, redirect ke halaman batch
            return redirect()->to(base_url('batch'));
        }
    }

    /**
     * Menghapus data produksi berdasarkan ID.
     * 
     * @param int $id ID data produksi
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function hapus($id = 0)
    {
        $produksi = $this->models->getDataById($id);

        if (!$produksi) {
            session()->setFlashdata('err', 'Gagal dihapus');
            return redirect()->to(base_url('batch'));
        }

        $qrPath = "QRcode/" . $produksi['qrcode'];
        if (is_file($qrPath)) {
            unlink($qrPath);
        }

        $hapus = $this->models->hapus($id);

        if ($hapus) {
            session()->setFlashdata('message', 'Berhasil Dihapus');
        } else {
            session()->setFlashdata('err', 'Gagal dihapus');
        }
        return redirect()->to(base_url('batch'));
    }

    /**
     * Mengubah data produksi.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function ubah()
    {
        // Validasi input form
        $rules = $this->validate([
            'id' => [
                'label' => "ID",
                'rules' => "required",
                'errors' => [
                    'required' => "ID tidak valid"
                ]
            ],
            'id_produk' => [
                'label' => "ID produk",
                'rules' => "required",
                'errors' => [
                    'required' => "ID produk tidak valid"
                ]
            ],
            'kode' => [
                'label' => "KODE",
                'rules' => "required",
                'errors' => [
                    'required' => "KODE tidak valid"
                ]
            ]
        ]);

        if (!$rules) {
            session()->setFlashdata('err', \Config\Services::validation()->listErrors());
            return redirect()->to(base_url('batch'));
        } else {
            $id = $this->request->getPost('id');
            // Ambil data batch lama
            $batchLama = $this->models->getDataById($id);

            // Hapus QR code lama jika ada
            $qrPathLama = "QRcode/" . $batchLama['qrcode'];
            if (is_file($qrPathLama)) {
                unlink($qrPathLama);
            }

            // Ambil bagian kode produk dan urutan dari kode batch lama
            $kodeProduk = substr($batchLama['kode'], 0, 3);
            $urutan = substr($batchLama['kode'], -3);

            // Ambil tanggal produksi baru dan format ddmmyy
            $tglProduksiBaru = date('dmY', strtotime($this->request->getPost("tgl_produksi")));
            $tglProduksiKode = date('dm', strtotime($this->request->getPost("tgl_produksi"))) . date('y', strtotime($this->request->getPost("tgl_produksi")));

            // Susun kode batch baru dengan format tanggal-bulan-tahun
            $kodeBatchBaru = $kodeProduk . $tglProduksiKode . $urutan;

            // Buat QR code baru
            $initial_qr = new MakeQRcode();
            $qrBaru = $initial_qr->make(rand(10, 1000000) . "_", $kodeBatchBaru);

            // Data yang akan diupdate
            $data = [
                'id_produk' => $this->request->getPost('id_produk'),
                'tgl_produksi' => $this->request->getPost("tgl_produksi"),
                'tgl_expire' => $this->request->getPost("tgl_expire"),
                'kode' => $kodeBatchBaru,
                'qrcode' => $qrBaru
            ];

            $success = $this->models->ubah($data, $id);
            if ($success) {
                session()->setFlashdata('message', 'Diubah');
                return redirect()->to(base_url('batch'));
            } else {
                session()->setFlashdata('err', 'Gagal Diubah');
                return redirect()->to(base_url('batch'));
            }
        }
    }
}
