  <style type="text/css">
    .form-input-file{
        cursor: pointer;
        border: 1px solid #cccccc;
        border-radius: 5px;
        padding: 5px 15px;
        margin: 5px;
        background: #ffffff;
        display: inline-block;
        transform: translateX(-5px);
    }

    .form-input-file:hover{
        background: #5cbd95;
        color: #fff;
    }

    .form-input-file:active{
        background: #9fa1a0;
    }

    .form-input-file input[type="file"]{
        position: absolute;
        top: -1000px;
    }
</style>
 
 <!-- Begin Page Content -->
 <div class="container-fluid h-100">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"> <?= $judul; ?></h1>

<?php if (session()->getFlashdata("err")): ?>
    <div class="alert alert-warning"><?= session()->getFlashdata("err") ?></div>
<?php endif ?>

<div class="card">
    <div class="card-body">
    <?php
     foreach($info->getResultArray() as $row){ ?>
    <div class="nama">
        <h4>Nama Perusahaan</h4>
        <p><?= $row['nama'] ?></p>
    </div>
    <br>
    <div class="foto">
    <h4>Foto Perusahaan</h4>
        <p style="width: 300px;"><img src="<?= base_url('foto_profile_perusahaan/').$row['foto'] ?>" alt="foto profile perusahaan" class="w-100 h-50"></p>
    </div>
    <br>
    <div class="deskripsi">
    <h4>Deskripsi Perusahaan</h4>
        <p><?= $row['deskripsi'] ?></p>
    </div> <br>
    <!-- <div class="edit">
    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalUpdate" id="btn-edit-info" 
        data-id="<?= $row['id']?>" data-nama="<?= $row['nama']?>" data-foto="<?= $row['foto']?>" data-deskripsi="<?= $row['deskripsi']?>">
        <i class="fa fa-edit"></i></button>
    </div> -->
    <?php } ?>
</div>
<!-- End of Main Content -->

<!--Modal box update data-->
<div class="modal fade" id="modalUpdate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update <?= $judul?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('info/ubah')?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id-info" value="<?= $row['id'] ?>">
                <div class="form-group mb-0">
                    <input type="hidden" name="file_old" value="<?= $row['foto'] ?>">
                    <label for="nama">Nama Perusahaan</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?= $row['nama']?>">
                    <!--<label for="foto">Foto Perusahaan</label><br>-->
                    <!--<input type="file" name="file" id="file"><br><br>-->
                    <label for="photoProduk">Foto Perusahaan</label>
                    <br>
                    <label class="form-input-file">
                        <input type="file" name="file" id="filesProduk" placeholder="Masukkan nama produk">
                        <span>Pilih Foto Perusahaan</span>
                    </label>
                    <br>
                    <label for="deksripsi">Deskripsi Perusahaan</label>
                    <textarea rows="2" class="form-control" name="deskripsi" id="deksripsi"><?= $row['deskripsi'] ?></textarea>
                    <!--<input type="text" name="deskripsi" id="deksripsi" class="form-control" value="<?= $row['deskripsi']?>">-->
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
