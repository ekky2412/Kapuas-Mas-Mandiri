<div id="layoutSidenav_content">
    <main>
        <div class="card-header"><i class="fas fa-table mr-1"></i>Pengirim</div>
        <div class="card-body">
            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengirim</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url('admin/tambah/pengirim') ?>" method="post">
                                <div class="form-group">
                                    <label for="nama">Nama Perusahaan</label>
                                    <input class="form-control" type="text" name="nama" id="nama">
                                </div class="form-group">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input class="form-control" type="text" name="alamat" id="alamat">
                                </div>
                                <div class="form-group">
                                    <label for="nickname">Kode Pengirim</label>
                                    <input class="form-control" type="text" name="nickname" id="nickname">
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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pengirim</th>
                            <th>Alamat</th>
                            <th>Kode Pengirim</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($pengirim as $p) {
                            echo "<tr>";
                            echo "<td>", $p['idPengirim'] . "</td>";
                            echo '<td>' . $p['namaPengirim'] . '</td>';
                            echo "<td>" . $p['alamatPengirim'] . "</td>";
                            echo "<td>" . $p['nicknamePengirim'] . "</td>";
                            echo "<td>";
                        ?>
                            <button type="button" class="btn btn-warning my-2 ml-2" data-toggle="modal" data-target="#editModal<?= $p['idPengirim'] ?>">
                                Edit
                            </button>
                            <div class="modal fade" id="editModal<?= $p['idPengirim'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModal<?= $p['idPengirim'] ?>">Edit Data Pengirim</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo base_url('admin/edit/pengirim') ?>" method="post">
                                                <input type="hidden" name="idPengirim" value="<?= $p['idPengirim'] ?>">
                                                <div class="form-group">
                                                    <label for="namaPengirim">Nama Pengirim</label>
                                                    <input class="form-control" type="text" name="namaPengirim" id="namaPengirim" value="<?= $p['namaPengirim'] ?>">
                                                </div class="form-group">
                                                <div class="form-group">
                                                    <label for="alamatPengirim">Alamat</label>
                                                    <input class="form-control" type="text" name="alamatPengirim" id="alamatPengirim" value="<?= $p['alamatPengirim'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nicknamePengirim">Kode Penerima</label>
                                                    <input class="form-control" type="text" name="nicknamePengirim" id="nicknamePengirim" value="<?= $p['nicknamePengirim'] ?>">
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
                            <a class='btn btn-danger mx-2' onclick="return confirm('Apakah anda ingin menghapus data ini?')" href="<?= base_url("admin/delete/pengirim/$p[idPengirim]") ?>">Hapus</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
    </main>
</div>


<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>