<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">
                <?= ($jam . ", ") ?>
                <?= $this->session->userdata('nama') ?>
            </h1>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-header ">Jumlah Order</div>
                        <div class="card-body text-right display-4 "><?php echo $OB; ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?= base_url('admin/orderbill') ?>">Lihat Selengkapnya</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-header ">Pengirim Terdaftar</div>
                        <div class="card-body text-right display-4"><?php echo $pengirim; ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?= base_url('admin/pengirim') ?>">Lihat Selengkapnya</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-header ">Penerima Terdaftar</div>
                        <div class="card-body text-right display-4"><?php echo $penerima; ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?= base_url('admin/penerima') ?>">Lihat Selengkapnya</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>