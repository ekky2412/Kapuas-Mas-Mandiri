<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="stylesheet" href="<?= base_url() ?>css/style2.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <!-- Load data table khusus tabel -->
    <?php
    if ($this->uri->segment(1) == 'admin' || $this->uri->segment(2) != 'index') {
    ?>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <?php
    }
    ?>
    <!-- Untuk Form Tambah Order Bill dan Detail Order Bill-->
    <?php
    if ($this->uri->segment(2) == 'tambahOrderBill' || $this->uri->segment(2) == 'detailOB') {
    ?>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <?php
    }
    ?>
    <title><?= $judul ?></title>
</head>

<body>
    <!-- Untuk Pesan FlashData -->
    <?php
    if ($this->session->flashdata('pesan')) {
    ?>
        <script type='text/javascript'>
            alert('<?= $this->session->flashdata('pesan') ?>')
        </script>
    <?php
        unset($_SESSION['pesan']);
    }
    ?>
    <!--  -->