 <?= $this->extend('templates/admin') ?>

 <?= $this->section('title') ?>
 Data Produk
 <?= $this->endSection() ?>

 <?= $this->section('css') ?>
 <style type="text/css">
     .form-input-file {
         cursor: pointer;
         border: 1px solid #cccccc;
         border-radius: 5px;
         padding: 5px 15px;
         margin: 5px;
         background: #ffffff;
         display: inline-block;
         transform: translateX(-5px);
     }

     .form-input-file:hover {
         background: #EFAA41;
         color: #fff;
     }

     .form-input-file:active {
         background: #9fa1a0;
     }

     .form-input-file input[type="file"] {
         position: absolute;
         top: -1000px;
     }
 </style>
 <?= $this->endSection() ?>

 <?= $this->section('content') ?>
 <!-- Begin Page Content -->
 <div class="container-fluid h-100">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"> Data Produk</h1>

     <?php if (session()->get('message')): ?>
         <div class="alert alert-success alert-dismissible fade show" role="alert">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
             Data Produk berhasil <strong><?= session()->getFlashdata('message'); ?></strong>
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
                             <th>Kode Produk</th>
                             <th>Nama Produk</th>
                             <th>Foto Produk</th>
                             <th>Komposisi</th>
                             <th>No PIR-T</th>
                             <th>Produsen</th>
                             <th>Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            foreach ($produk->getResultArray() as $key => $row) { ?>
                             <tr>
                                 <td class="align-middle"><?= $row['kode_produk'] ?></td>
                                 <td class="align-middle"><?= $row['nama'] ?></td>
                                 <td class="align-middle"><img src="<?= base_url('foto_product/') . $row['foto'] ?>?>" alt="Foto Product" width="100"></td>
                                 <td class="align-middle"><?= $row['komposisi'] ?></td>
                                 <td class="align-middle"><?= $row['no_pirt'] ?></td>
                                 <td class="align-middle"><?= $row['produsen'] ?></td>
                                 <td class="align-middle">
                                     <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalUpdate<?= $key ?>" id="btn-edit-produk"
                                         data-id="<?= $row['id'] ?>" data-kode="<?= $row['kode_produk'] ?>" data-nama="<?= $row['nama'] ?>" data-foto="<?= $row['foto'] ?>" data-khas="<?= $row['komposisi'] ?>"
                                         data-ijin="<?= $row['no_pirt'] ?>" data-prod="<?= $row['produsen'] ?>">
                                         <i class="fa fa-edit"></i></button>
                                     <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalHapus<?= $key ?>">
                                         <i class="fa fa-trash-alt"></i>
                                     </button>
                                 </td>
                             </tr>
                         <?php } ?>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>
 <!-- /.container-fluid -->
 <!-- End of Main Content -->


 <!--Modal box tambah data-->
 <div class="modal fade" id="modalTambah">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Tambah Produk</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="<?= base_url('produk/tambah') ?>" method="post" enctype="multipart/form-data">
                     <div class="form-group mb-0">
                         <label for="kode">Kode Produk <span class="text-danger">*</span></label>
                         <input type="text" name="kode" id="kode" class="form-control" placeholder="Masukkan kode produk" required>
                         <label for="nama">Nama Produk <span class="text-danger">*</span></label>
                         <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama produk">
                         <label for="photoProduk">Foto Produk <span class="text-danger">*</span></label>
                         <br>
                         <label class="form-input-file">
                             <input type="file" name="file" id="filesProduk" placeholder="Masukkan nama produk">
                             <span>Pilih Foto Produk</span>
                         </label>
                         <br>
                         <label for="khas">Komposisi <span class="text-danger">*</span></label>
                         <input type="text" name="komposisi" id="khas" class="form-control" placeholder="Masukkan komposisi produk">
                         <label for="No_PIR-T">No PIR-T <span class="text-danger">*</span></label>
                         <input type="text" name="No_PIR-T" id="ijin" class="form-control" placeholder="Masukkan PIRT produk">
                         <label for="pro">Produsen <span class="text-danger">*</span></label>
                         <input type="text" name="prod" id="prod" class="form-control" placeholder="Masukkan produsen produk">
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

 <?php foreach ($produk->getResultArray() as $key => $row) { ?>
     <!--Modal box hapus data-->
     <div class="modal fade" id="modalHapus<?= $key ?>">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Hapus Produk</h5>
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
                     <a href="<?= base_url('produk/hapus/' . $row['id']) ?>" name="hapus" class="btn btn-danger">Ya, Hapus!</a>
                 </div>
             </div>
         </div>
     </div>
 <?php } ?>


 <!--Modal box update data-->
 <?php foreach ($produk->getResultArray() as $key => $row) { ?>
     <div class="modal fade" id="modalUpdate<?= $key ?>">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Update Produk</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <form action="<?= base_url('produk/ubah') ?>" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="id" id="id-produk">
                         <div class="form-group mb-0">
                             <label for="kode">Kode Produk <span class="text-danger">*</span></label>
                             <input type="text" name="kode" id="kode" class="form-control" placeholder="Masukkan kode produk" value="<?= $row['kode_produk'] ?>">
                             <label for="nama">Nama Produk <span class="text-danger">*</span></label>
                             <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama produk" value="<?= $row['nama'] ?>">
                             <!--<label for="nama">Foto Produk</label>-->
                             <!--<input type="file" name="file" id="file" class="form-control" placeholder="Masukkan Foto produk" value="<?= base_url('foto_product/' . $row['foto']) ?>">-->
                             <label for="photoProduk">Foto Produk</label>
                             <br>
                             <label class="form-input-file">
                                 <input type="file" name="file" id="filesProduk" placeholder="Masukkan nama produk">
                                 <span>Pilih Foto Produk</span>
                             </label>
                             <br>
                             <label for="komposisi">Komposisi <span class="text-danger">*</span></label>
                             <input type="text" name="komposisi" id="komposisi" class="form-control" placeholder="Masukkan khasiat produk" value="<?= $row['komposisi'] ?>">
                             <label for="No_PIR-T">No PIR-T <span class="text-danger">*</span></label>
                             <input type="text" name="No_PIR-T" id="No_PIR-T" class="form-control" placeholder="Masukkan ijin edar produk" value="<?= $row['no_pirt'] ?>">
                             <label for="pro">Produsen <span class="text-danger">*</span></label>
                             <input type="text" name="prod" id="prod" class="form-control" placeholder="Masukkan produsen produk" value="<?= $row['produsen'] ?>">
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
 <?php } ?>
 <?= $this->endSection() ?>