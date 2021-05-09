<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="head">
                <h1>Edit Nomor OB : <?= $orderbill['nomorOB'] ?></h1>
                <a class="btn btn-warning" href="<?= base_url('admin/editOB/') . $orderbill['nomorOB'] ?>">Edit</a>
                <?php
                if ($orderbill['pelunasan'] == '' || $orderbill['pelunasan'] == 'BELUM LUNAS') {
                ?>
                    <button data-toggle="modal" data-target="#pelunasanModal" id="pelunasanModal" class="btn btn-danger">BELUM LUNAS</button>
                <?php
                } else if ($orderbill['pelunasan'] == 'LUNAS') {
                ?>
                    <button data-toggle="modal" data-target="#pelunasanModal" id="pelunasanModal" class="btn btn-success">LUNAS</button>
                <?php
                }
                ?>

        <div class="modal fade" id="pelunasanModal" tabindex="-1" role="dialog" aria-labelledby="pelunasanModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pelunasanModal">Edit Data Debet</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url('admin/edit/pelunasan') ?>" method="post">
                                <input type="hidden" name="nomorOB" value="<?= $orderbill['nomorOB'] ?>">
                                <div class="form-group">
                                    <label for="noDebet">Nomor Debet</label>
                                    <input class="form-control" type="text" name="noDebet" id="noDebet" value="<?= $orderbill['noDebet'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="tanggalDebet">Tanggal Debet </label>
                                    <input class="form-control" type="date" name="tanggalDebet" id="tanggalDebet" value="<?= $orderbill['tanggalDebet'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="jumlahDebet">Jumlah Debet </label>
                                    <input class="form-control" type="text" name="jumlahDebet" id="jumlahDebet" value="<?= $orderbill['jumlahDebet'] ?>">
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <input type="checkbox" name="lunas" value="LUNAS" <?php
                                            if($orderbill['pelunasan'] == 'LUNAS')
                                            echo "checked";
                                        ?>>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
                

            </div>

            <hr>
            <div class="form-group">
                <label for="">Tanggal Orderbill : </label>
                <p><?= date('d F Y', strtotime($orderbill['tanggalOB'])) ?></p>
            </div>
            <div class="form-group">
                <label for="">Nama Kapal : </label>
                <p><?= $orderbill['namaKapal'] . " V. " . $orderbill['voy']  ?></p>
            </div>
            <div class="form-group">
                <label for="">Nama Pengirim : </label>
                <p><?= $orderbill['namaPengirim'] ?></p>
            </div>
            <div class="form-group">
                <label for="">Nama Penerima : </label>
                <p><?= $orderbill['namaPenerima'] ?></p>
            </div>
            <div class="form-group">
                <label for="">Tanggal Tiba : </label>
                <p><?= $orderbill['tanggalTiba'] ? date('d F Y', strtotime($orderbill['tanggalTiba'])) : '' ?></p>
            </div>
            <div class="form-group">
                <label for="">Tanggal Kapal Sandar : </label>
                <p><?= $orderbill['tanggalSandar'] ? date('d F Y', strtotime($orderbill['tanggalSandar'])) : ''?></p>
            </div>
            <div class="form-group">
                <label for="">Nomor BL : </label>
                <p><?= $orderbill['noBL'] ?></p>
            </div>
            <div class="form-group">
                <label for="">Tanggal BL : </label>
                <p><?= $orderbill['tanggalBL'] ? date('d F Y', strtotime($orderbill['tanggalBL'])) : '' ?></p>
            </div>
            <div class="form-group">
                <label for="">Status BL : </label>
                <p><?= $orderbill['statusBL'] ?></p>
            </div>
            <div class="form-group">
                <label for=""> Ukuran Container : </label>
                <p><?= $orderbill['ukuranContainer'] ?></p>
            </div>
            <div class="form-group">
                <label for=""> Agent Pelayaran : </label>
                <p><?= $orderbill['agentPelayaran'] ?></p>
            </div>
            <div class="form-group">
                <label for=""> Tanggal Barang Diterima : </label>
                <p><?= $orderbill['tanggalDiterima'] ? date('d F Y', strtotime($orderbill['tanggalDiterima'])) : '' ?></p>
            </div>
            <!--  -->
            <div class="form-group">
                <h3>List Container</h3>
                <button class="btn btn-success my-2 ml-2" data-toggle="modal" data-target="#tambahContainerModal">Tambah Container</button>

                <div class="modal fade" id="tambahContainerModal" tabindex="-1" role="dialog" aria-labelledby="tambahContainerModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahContainerModal">Tambah Data Container</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo base_url('admin/tambah/container') ?>" method="post">
                                    <input type="hidden" name="nomorOB" value="<?= $orderbill['nomorOB'] ?>">
                                    <div class="form-group">
                                        <label for="noContainer">Nomor Kontainer </label>
                                        <input class="form-control" type="text" name="noContainer" id="noContainer">
                                    </div>
                                    <div class="form-group">
                                        <label for="seal">Seal </label>
                                        <input class="form-control" type="text" name="seal" id="seal">
                                    </div>
                                    <div class="form-group">
                                        <label for="isiContainer">Nama Barang </label>
                                        <input class="form-control" type="text" name="isiContainer" id="isiContainer">
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label for="jumlah">Jumlah</label>
                                            <input class="form-control" type="text" name="jumlah" id="jumlah">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="tipeJumlah">Satuan</label>
                                            <input class="form-control" type="text" name="tipeJumlah" id="tipeJumlah">
                                        </div>
                                    </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <table class="table table-bordered" id="dataContainer" width="100%" cellspacing="0">
                    <thead>
                        <th>Nomor</th>
                        <th>Kontainer</th>
                        <th>Seal</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($container as $c) {
                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $c['noContainer'] ?></td>
                                <td><?= $c['seal'] ?></td>
                                <td><?= $c['isiContainer'] ?></td>
                                <td><?= $c['jumlah'] . " " . $c['tipeJumlah'] ?></td>
                                <td>

                                    <button type="button" class="btn btn-warning my-2 ml-2" data-toggle="modal" data-target="#editModalContainer<?= $i ?>">
                                        Edit
                                    </button>
                                    <div class="modal fade" id="editModalContainer<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalContainer<?= $i ?>">Edit Data Container</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo base_url('admin/edit/container') ?>" method="post">
                                                        <input type="hidden" name="nomorOB" value="<?= $orderbill['nomorOB'] ?>">
                                                        <input type="hidden" name="noContainerSebelum" value="<?= $c['noContainer'] ?>">
                                                        <div class="form-group">
                                                            <label for="noContainer">Nomor Kontainer </label>
                                                            <input class="form-control" type="text" name="noContainer" id="noContainer" value="<?= $c['noContainer'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="seal">Seal </label>
                                                            <input class="form-control" type="text" name="seal" id="seal" value="<?= $c['seal'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="isiContainer">Nama Barang </label>
                                                            <input class="form-control" type="text" name="isiContainer" id="isiContainer" value="<?= $c['isiContainer'] ?>">
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-md-6">
                                                                <label for="jumlah">Jumlah</label>
                                                                <input class="form-control" type="text" name="jumlah" id="jumlah" value="<?= $c['jumlah'] ?>">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="tipeJumlah">Satuan</label>
                                                                <input class="form-control" type="text" name="tipeJumlah" id="tipeJumlah" value="<?= $c['tipeJumlah'] ?>">
                                                            </div>
                                                        </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form action="<?= base_url('admin/delete/container') ?>" method="POST">
                                        <input type="hidden" name="noContainer" value="<?= $c['noContainer'] ?>">
                                        <input type="hidden" name="nomorOB" value="<?= $orderbill['nomorOB'] ?>">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda ingin menghapus data ini?')">Hapus</button>
                                    </form>

                                </td>
                            </tr>
                        <?php
                            $i = $i + 1;
                        }
                        ?>
                    </tbody>
                </table>
            </div>


            <!-- direktur -->
            <div class="form-group">
                <h3>List Pembayaran</h3>

                <button class="btn btn-success my-2 ml-2" data-toggle="modal" data-target="#tambahPembayaranModal">Tambah Data Pembayaran</button>
                <a target="_blank" href="<?= base_url('cetakpdf/cetakPembayaran/') . $orderbill['nomorOB'] ?>"><button class="btn btn-warning"> Cetak Pembayaran </button></a>
                <div class="modal fade" id="tambahPembayaranModal" tabindex="-1" role="dialog" aria-labelledby="tambahPembayaranModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahPembayaranModal">Tambah Data Pembayaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo base_url('admin/tambah/pembayaran') ?>" method="post">
                                    <input type="hidden" name="nomorOB" value="<?= $orderbill['nomorOB'] ?>">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input class="form-control" type="date" name="tanggal" id="tanggal">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan </label>
                                        <input class="form-control" type="text" name="keterangan" id="keterangan">
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label for="cash">Cash </label>
                                            <input class="form-control" type="number" name="cash" id="cash">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="tipecash">Tipe Cash</label>
                                            <select class="form-control" name="tipecash" id="tipecash">
                                                <option value="cash1">CASH 1</option>
                                                <option value="cash2">CASH 2</option>
                                                <option value="cash3">CASH 3</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <table class="table table-bordered" id="dataPembayaran" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="align-middle" rowspan="2">Nomor</th>
                            <th class="align-middle" rowspan="2">Tanggal</th>
                            <th class="align-middle" rowspan="2">Keterangan</th>
                            <th class="align-middle" colspan="3">Status Pembayaran</th>
                            <th class="align-middle" rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            <th class="align-middle">CASH 1<br>THC + LOLO</td>
                            <th class="align-middle">CASH 2<br>DOORING</td>
                            <th class="align-middle">CASH 3<br>ONGKIR</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $j = 1;
                        foreach ($pembayaran as $p) {
                        ?>
                            <tr>
                                <td><?= $j ?></td>
                                <td><?= $p['tanggal'] ?></td>
                                <td><?= $p['keterangan'] ?></td>
                                <td><?= $p['cash1'] ?></td>
                                <td><?= $p['cash2'] ?></td>
                                <td><?= $p['cash3'] ?></td>
                                <td>

                                    <button type="button" class="btn btn-warning my-2 ml-2" data-toggle="modal" data-target="#editModalPembayaran<?= $j ?>">
                                        Edit
                                    </button>
                                    <div class="modal fade" id="editModalPembayaran<?= $j ?>" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalPembayaran<?= $j ?>">Edit Data Pembayaran</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo base_url('admin/edit/pembayaran') ?>" method="post">
                                                        <input type="hidden" name="nomorOB" value="<?= $orderbill['nomorOB'] ?>">
                                                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                                        <div class="form-group">
                                                            <label for="tanggal">Tanggal</label>
                                                            <input class="form-control" type="date" name="tanggal" id="tanggal" value="<?= date('d m Y', strtotime($p['tanggal']))  ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="keterangan">Keterangan </label>
                                                            <input class="form-control" type="text" name="keterangan" id="keterangan" value="<?= $p['keterangan'] ?>">
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-md-6">
                                                                <label for="cash">Cash </label>
                                                                <input class="form-control" type="number" name="cash" id="cash" value="
                                                                <?php

                                                                if (!empty($p['cash1'])) {
                                                                    echo number_format( $p['cash1'],0,',','.');
                                                                } else if (!empty($p['cash2'])) {
                                                                    echo number_format($p['cash2'],0,',','.');
                                                                } else if (!empty($p['cash3'])) {
                                                                    echo number_format($p['cash3'],0,',','.');
                                                                }

                                                                ?>">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="tipecash">Tipe Cash</label>
                                                                <select class="form-control" name="tipecash" id="tipecash">
                                                                    <option value="cash1" <?php if (!is_null($p['cash1'])) {
                                                                                                echo "selected";
                                                                                            } ?>>CASH 1</option>
                                                                    <option value="cash2" <?php if (!is_null($p['cash2'])) {
                                                                                                echo "selected";
                                                                                            } ?>>CASH 2</option>
                                                                    <option value="cash3" <?php if (!is_null($p['cash3'])) {
                                                                                                echo "selected";
                                                                                            } ?>>CASH 3</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form action="<?= base_url('admin/delete/pembayaran') ?>" method="POST">
                                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                        <input type="hidden" name="nomorOB" value="<?= $orderbill['nomorOB'] ?>">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda ingin menghapus data ini?')">Hapus</button>
                                    </form>

                                </td>
                            </tr>
                        <?php
                            $j = $j + 1;
                        }
                        ?>
                    </tbody>
                </table>

            </div>
            <!-- direktur end -->

        </div>
    </main>
</div>

<script>
    $(document).ready(function() {
        $('#dataPembayaran').DataTable();
        $('#dataContainer').DataTable();
    });
</script>