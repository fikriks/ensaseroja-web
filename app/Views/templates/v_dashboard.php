<div class="container-fluid">
 <!-- Content Row -->
  <div class="row">
 <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100 py-2" style="border-left: 5px solid #EFAA41 !important;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Data Produk</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($produk->getResultArray()) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tags fa-2x text-black-200"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100 py-2" style="border-left: 5px solid #EFAA41 !important;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Data Kode Produksi</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($batch->getResultArray()) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-info fa-2x text-black-200"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     
</div>

