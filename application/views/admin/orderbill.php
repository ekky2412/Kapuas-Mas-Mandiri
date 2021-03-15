<div id="layoutSidenav_content">
    <main>
        <div class="card-header"><i class="fas fa-table mr-1"></i>Order Bill</div>
        <div class="card-body">
            <a class="btn btn-success mb-3" href="<?= base_url() ?>admin/tambahOrderBill">
                Tambah Data
            </a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kapal</th>
                            <th>Nama Pengirim</th>
                            <th>Nama Penerima</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($orderbill as $p) {
                            echo "<tr>";
                            echo "<td>", $p['nomorOB'] . "</td>";
                            echo '<td>' . $p['namaKapal'] . ' V.' . $p['voy'] . '</td>';
                            echo "<td>" . $p['namaPengirim'] . "</td>";
                            echo "<td>" . $p['namaPenerima'] . "</td>";
                            echo "<td>";
                        ?>
                            <a class="btn btn-primary" href="<?= base_url() ?>admin/detailOB/<?= $p['nomorOB'] ?>"> Detail </a>
                            <a class="btn btn-success" target="_blank" href="<?= base_url('cetakpdf/cetakBA/').$p['nomorOB'] ?>"> Cetak </a>
                        <?php
                            // echo "<a class='btn btn-success my-2 ml-2' href=";
                            // echo base_url("admin/orderbill/$p[nomorOB]");
                            // echo ">Detail</a>";

                            // echo "</tr>";
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