<?= $this->extend('templates/admin') ?>

<?= $this->section('title') ?>
Data Kode Produksi
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid h-100">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"> Kode Produksi</h1>

    <?php if (session()->get('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data Produksi berhasil <strong><?= session()->getFlashdata('message'); ?></strong>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <?php
            if (session()->get('err')) {
                echo "<div class='alert alert-danger' role='alert'>" . session()->get('err') . "</div>";
            }
            ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <!--Button tiger modal-->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                <i class="fa fa-plus"></i> Tambah Data
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Produksi</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Foto Produk</th>
                            <th>Komposisi</th>
                            <th>No PIR-T</th>
                            <th>Produsen</th>
                            <th>Tanggal Produksi</th>
                            <th>Tanggal Expire</th>
                            <th>QR Code</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($join->getResultArray() as $key => $row) { ?>
                            <tr>
                                <td class="align-middle" scope="row"><?= $key + 1; ?></td>
                                <td class="align-middle"><?= $row['kode'] ?></td>
                                <td class="align-middle"><?= $row['kode_produk'] ?></td>
                                <td class="align-middle"><?= $row['nama'] ?></td>
                                <td class="align-middle"><img src="<?= base_url('foto_product/') . $row['foto'] ?>" width="100"></td>
                                <td class="align-middle"><?= $row['komposisi'] ?></td>
                                <td class="align-middle"><?= $row['no_pirt'] ?></td>
                                <td class="align-middle"><?= $row['produsen'] ?></td>
                                <td class="align-middle"><?= $row['tgl_produksi'] ?></td>
                                <td class="align-middle"><?= $row['tgl_expire'] ?></td>
                                <td class="align-middle"><a href="<?= base_url('QRcode/') . $row['qrcode'] ?>" download><img src="<?= base_url('QRcode/') . $row['qrcode'] ?>" alt=""></a></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalUpdate<?= $key; ?>" id="btn-edit-batch" data-id="<?= $row['id'] ?>" data-kodebatch="<?= $row['kode'] ?>" data-idproduk="<?= $row['id_produk'] ?>">
                                        <i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalHapus<?= $key ?>">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="modalUpdate<?= $key; ?>">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Kode Produksi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refresh()">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url('batch/ubah') ?>" method="post">
                                                <input type="hidden" name="id_produk" id="id_produk" value="<?= $row['id_produk'] ?> ">
                                                <input type="hidden" name="id" id="id_batch" value="<?= $row['id'] ?>">
                                                <div class="form-group mb-0">
                                                    <label for="kode">Kode Produksi</label>
                                                    <input type="text" name="kode" id="kode" class="form-control" placeholder="Masukkan kode Produksi" value="<?= $row['kode'] ?>" readonly>
                                                    <label for="tgl_produksi">Tanggal Produksi</label>
                                                    <input type="date" name="tgl_produksi" id="tgl_produksi_edit" class="form-control" value="<?= $row['tgl_produksi'] ?>" readonly>
                                                    <label for="tgl_expire">Tanggal Expire</label>
                                                    <input type="date" name="tgl_expire" id="tgl_expire_edit" class="form-control" value="<?= $row['tgl_expire'] ?>" readonly>
                                                    <!-- <label for="nama">QRCode</label> -->
                                                    <input type="hidden" name="qrcode" id="qrcode" class="form-control" placeholder="Masukkan nama produk" value="<?= $row['qrcode'] ?>">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="ubah" class="btn btn-primary">Update Data</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modalHapus<?= $key; ?>">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus Kode Produksi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-0">
                                                Apakah anda yakin ingin menghapus?
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('batch/hapus/' . $row['id']) ?>" name="hapus" class="btn btn-danger">Ya, Hapus!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End of Main Content -->

        <!--Modal box tambah data-->
        <div class="modal fade" id="modalTambah">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kode Produksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('batch/tambah') ?>" method="post">
                            <div class="form-group mb-0">
                                <label for="kode_produksi">Kode Produksi <span class="text-danger">*</span></label>
                                <input type="text" id="kode_produksi" class="form-control" placeholder="Kode Produksi" readonly>
                                <label for="nama">Produk <span class="text-danger">*</span></label>
                                <select class="custom-select" id="inputGroupSelect02" name="idproduk">
                                    <option selected disabled>Pilih</option>
                                    <?php foreach ($produk->getResultObject() as $val) { ?>
                                        <option value="<?= $val->id ?>" data-kode="<?= $val->kode_produk ?>"><?= $val->nama ?></option>
                                    <?php } ?>
                                </select>
                                <div id="dataDummy"></div>
                                <label for="tgl_produksi">Tanggal Produksi <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_produksi" id="tgl_produksi" class="form-control" value="<?= date('Y-m-d') ?>">
                                <label for="tgl_expire">Tanggal Expire <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_expire" id="tgl_expire" class="form-control" readonly>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    let selectP = document.getElementById("inputGroupSelect02");
    let dummy = document.getElementById("dataDummy");

    function refresh() {
        location.reload();
    }

    function setExpireDate() {
        let produksi = $('#tgl_produksi').val();
        if (produksi) {
            let produksiDate = new Date(produksi);
            produksiDate.setMonth(produksiDate.getMonth() + 6);

            // Handle jika bulan lebih dari Desember
            let year = produksiDate.getFullYear();
            let month = (produksiDate.getMonth() + 1).toString().padStart(2, '0');
            let day = produksiDate.getDate().toString().padStart(2, '0');

            let expireFormatted = `${year}-${month}-${day}`;
            $('#tgl_expire').val(expireFormatted);
        }
    }

    // Saat halaman pertama kali load
    setExpireDate();

    // Saat tanggal produksi diubah
    $('#tgl_produksi').on('change', function() {
        setExpireDate();
        updateKodeProduksi();
    });

    // Saat produk diubah
    $('#inputGroupSelect02').on('change', function() {
        updateKodeProduksi();
    });

    function updateKodeProduksi() {
        let produkElement = $('#inputGroupSelect02 option:selected');
        let produkKode = produkElement.data('kode');
        let produksi = $('#tgl_produksi').val();
        if (produkKode && produksi) {
            let produksiDate = new Date(produksi);
            let day = produksiDate.getDate().toString().padStart(2, '0');
            let month = (produksiDate.getMonth() + 1).toString().padStart(2, '0');
            let year = produksiDate.getFullYear().toString().slice(-2);

            let kodeProduksi = produkKode + day + month + year;
            $('#kode_produksi').val(kodeProduksi);
        }
    }
</script>
<?= $this->endSection() ?>