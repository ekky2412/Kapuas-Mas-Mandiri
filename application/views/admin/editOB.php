<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

            <div class="head">
                <h1>Edit Nomor OB : <?= $orderbill['nomorOB'] ?></h1>
                <a class="btn btn-warning" href="<?= base_url('admin/detailOB/') . $orderbill['nomorOB'] ?>">Kembali</a>
            </div>

            <form action="<?= base_url('admin/edit/OB') ?>" method="post">
                <input type="hidden" name="nomorOB" value="<?= $orderbill['nomorOB'] ?>">
                <div class="form-group">
                    <label for="namaKapal">Nama Kapal : </label>
                    <input class="form-control" type="text" name="namaKapal" id="namaKapal" value="<?= $orderbill['namaKapal'] ?>">
                </div>
                <div class="form-group">
                    <label for="voy">Voy</label>
                    <input class="form-control" type="text" name="voy" id="voy" value="<?= $orderbill['voy'] ?>">
                </div>
                <div class="form-group">
                    <label for="tanggalOB">Tanggal Orderbill : </label>
                    <input class="form-control" type="date" name="tanggalOB" id="tanggalOB" value="<?= $orderbill['tanggalOB'] ?>">
                </div>
                <div class="form-group">
                    <label for="namaPengirim">Nama Pengirim</label>
                    <select class="form-control" name="namaPengirim" id="namaPengirim">
                        <?php
                        foreach ($pengirim as $p) {
                        ?>
                            <option value="<?= $p['idPengirim'] ?>" <?php if ($orderbill['pengirim'] == $p['idPengirim']) {
                                                                        echo "selected";
                                                                    } ?>><?= $p['namaPengirim'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <small class="text-danger">Jika belum ada nama pengirim, tambahkan dahulu di <a href="<?= base_url('admin/pengirim') ?>">sini</a></small>
                </div>
                <div class="form-group">
                    <label for="namaPenerima">Nama Penerima</label>
                    <select class="form-control" name="namaPenerima" id="namaPenerima">
                        <?php
                        foreach ($penerima as $p) {
                        ?>
                            <option value="<?= $p['idPenerima'] ?>" <?php if ($orderbill['penerima'] == $p['idPenerima']) {
                                                                        echo "selected";
                                                                    } ?>><?= $p['namaPenerima'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <small class="text-danger">Jika belum ada nama penerima, tambahkan dahulu di <a href="<?= base_url('admin/penerima') ?>">sini</a></small>
                </div>

                <div class="form-group">
                    <label for="tanggalTiba">Tanggal Tiba : </label>
                    <input class="form-control" type="date" name="tanggalTiba" id="tanggalTiba" value="<?= $orderbill['tanggalTiba'] ?>">
                </div>

                <div class="form-group">
                    <label for="tanggalSandar">Tanggal Kapal Sandar</label>
                    <input class="form-control" type="date" name="tanggalSandar" id="tanggalSandar" value="<?= $orderbill['tanggalSandar'] ?>">
                </div>
                <div class="form-group">
                    <label for="noBL">Nomor BL :</label>
                    <input class="form-control" type="text" name="noBL" id="noBL" value="<?= $orderbill['noBL'] ?>">
                </div>
                <div class="form-group">
                    <label for="tanggalBL">Tanggal BL : </label>
                    <input class="form-control" type="date" name="tanggalBL" id="tanggalBL" value="<?= $orderbill['tanggalBL'] ?>">
                </div>
                <div class="form-group">
                    <label for="statusBL">Status BL : </label>
                    <input class="form-control" type="text" name="statusBL" id="statusBL" value="<?= $orderbill['statusBL'] ?>">
                </div>
                <div class="form-group">
                    <label for="ukuranContainer">Ukuran Container : </label>
                    <input class="form-control" type="text" name="ukuranContainer" id="ukuranContainer" value="<?= $orderbill['ukuranContainer'] ?>">
                </div>
                <div class="form-group">
                    <label for="agentPelayaran">Agent Pelayaran : </label>
                    <input class="form-control" type="text" name="agentPelayaran" id="agentPelayaran" value="<?= $orderbill['agentPelayaran'] ?>">
                </div>
                <div class="form-group">
                    <label for="tanggalDiterima">Tanggal Diterima : </label>
                    <input class="form-control" type="date" name="tanggalDiterima" id="tanggalDiterima" value="<?= $orderbill['tanggalDiterima'] ?>">
                </div>
                <div class="form-group">
                    <label for="namaMandor">Nama Mandor : </label>
                    <input class="form-control" type="text" name="namaMandor" id="namaMandor" value="<?= $orderbill['namaMandor'] ?>">
                </div>
                <div class="form-group">
                    <label for="noHpMandor">Nomor HP Mandor : </label>
                    <input class="form-control" type="text" name="noHpMandor" id="noHpMandor" value="<?= $orderbill['noHpMandor'] ?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </main>
</div>