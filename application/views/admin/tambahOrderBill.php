<div id="layoutSidenav_content">
    <main>
        <div class="card-body">

            <h1>Tambah Order Bill</h1>

            <form action="<?php echo base_url('admin/tambah/OB') ?>" method="post">
                <div class="form-group">
                    <label for="nomorOB">Nomor OB</label>
                    <input class="form-control" type="text" name="nomorOB" id="nomorOB">
                </div>
                <div class="form-group">
                    <label for="namaPengirim">Nama Pengirim</label>
                    <select class="form-control" name="namaPengirim" id="namaPengirim">
                        <option></option> <!-- Opsi Blank Untuk Jquery -->
                        <?php
                        foreach ($pengirim as $p) {
                        ?>
                        <option value="<?= $p['idPengirim'] ?>"><?= $p['namaPengirim'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <small class="text-danger">Jika belum ada nama pengirim, tambahkan dahulu di <a href="<?= base_url('admin/pengirim') ?>">sini</a></small>
                </div>
                <div class="form-group">
                    <label for="namaPenerima">Nama Penerima</label>
                    <select class="form-control" name="namaPenerima" id="namaPenerima">
                        <option></option> <!-- Opsi Blank Untuk Jquery -->
                        <?php
                        foreach ($penerima as $p) {
                        ?>
                        <option value="<?= $p['idPenerima'] ?>"><?= $p['namaPenerima'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <small class="text-danger">Jika belum ada nama penerima, tambahkan dahulu di <a href="<?= base_url('admin/penerima') ?>">sini</a></small>
                </div>
                <div class="form-group">
                    <label for="namaKapal">Nama Kapal</label>
                    <input class="form-control" type="text" name="namaKapal" id="namaKapal">
                </div>
                <div class="form-group">
                    <label for="voy">No. Voy</label>
                    <input class="form-control" type="text" name="voy" id="voy">
                </div>
                <div class="form-group">
                    <label for="tanggalOB">Tanggal OB</label>
                    <input class="form-control" type="date" name="tanggalOB" id="tanggalOB">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
    $(document).ready(function(){
        $('#namaPengirim').select2({
            placeholder: "Nama Pengirim"
        });
        $('#namaPenerima').select2({
            placeholder: "Nama Penerima"
        });
    })
</script>