<div id="layoutSidenav_content">
    <main>
        <div class="card-header"><i class="fas fa-table mr-1"></i>Penerima</div>
        <div class="card-body">
            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penerima</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url('admin/tambah/penerima') ?>" method="post">
                                <div class="form-group">
                                    <label for="nama">Nama Perusahaan</label>
                                    <input class="form-control" type="text" name="nama" id="nama">
                                </div class="form-group">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input class="form-control" type="text" name="alamat" id="alamat">
                                </div>
                                <div class="form-group">
                                    <label for="nickname">Kode Penerima</label>
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
                            <th>Nama Penerima</th>
                            <th>Alamat</th>
                            <th>Kode Penerima</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($penerima as $p) {
                            echo "<tr>";
                            echo "<td>". $p['idPenerima'] . "</td>";
                            echo '<td>' . $p['namaPenerima'] . '</td>';
                            echo "<td>" . $p['alamatPenerima'] . "</td>";
                            echo "<td>" . $p['nicknamePenerima'] . "</td>";
                            echo "<td>";
                        ?>
                            <button type="button" class="btn btn-warning my-2 ml-2" data-toggle="modal" data-target="#editModal<?= $p['idPenerima'] ?>">
                                Edit
                            </button>
                            <div class="modal fade" id="editModal<?= $p['idPenerima'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModal<?= $p['idPenerima'] ?>">Edit Data Penerima</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo base_url('admin/edit/penerima') ?>" method="post">
                                            <input type="hidden" name="idPenerima" value="<?= $p['idPenerima'] ?>">
                                                <div class="form-group">
                                                    <label for="namaPenerima">Nama Penerima</label>
                                                    <input class="form-control" type="text" name="namaPenerima" id="namaPenerima" value="<?= $p['namaPenerima'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamatPenerima">Alamat</label>
                                                    <input class="form-control" type="text" name="alamatPenerima" id="alamatPenerima" value="<?= $p['alamatPenerima'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nicknamePenerima">Kode Penerima</label>
                                                    <input class="form-control" type="text" name="nicknamePenerima" id="nicknamePenerima" value="<?= $p['nicknamePenerima'] ?>">
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
                            <a class='btn btn-danger mx-2' onclick="return confirm('Apakah anda ingin menghapus data ini?')" href="<?= base_url("admin/delete/penerima/$p[idPenerima]") ?>">Hapus</a></td>
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