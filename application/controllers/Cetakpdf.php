<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
// stream_context_set_default([
//     'ssl' => [
//         'verify_peer' => false,
//         'verify_peer_name' => false
//     ]
// ]);

// use setasign\FpdF\FpdF;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\StreamReader;
use \setasign\Fpdi\FpdfTpl;
include_once APPPATH . 'third_party/autoload.php';
// define('FPDF_FONTPATH','/third_party/font');

class Cetakpdf extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // $this->load->library('fpdf');
        $this->load->library('Fpdi');
        $this->load->model("database_model", "model");
    }

    public function cetakBA($total, $orderpengirim, $nicknamePengirim, $bulan, $tahun)
    {
        $session = $this->session->userdata('nama');
        if(empty($session)){
                redirect(base_url());
        }
        $nomorOB = array("nomorOB" => $total . "/" . $orderpengirim . "/" . $nicknamePengirim . "/" . $bulan . "/" . $tahun);
        $data['ob'] = $this->model->getDataOB($nomorOB);
        $data['container'] = $this->model->getData('rinciancontainer', $nomorOB);
        // echo '<pre>',var_dump($data),'</pre>';

        $pdf = new FPDI('P', 'mm', 'A4');

        $pdf->AddPage();
        $pdf->SetFont('Times');

        $source = base_url() . "assets/beritaacara.pdf";
        $fileContent = file_get_contents($source, 'rb');
        $pagecount = $pdf->setSourceFile(StreamReader::createByString($fileContent)); //source of your PDF template
        $tpl = $pdf->importPage(1);
        $pdf->useTemplate($tpl, 1, 1);

        // nomor BA

        $nomorBA = "NO. " . str_pad($orderpengirim, 3, "0", STR_PAD_LEFT) . "/" . $total . "/" . $data['ob']['nicknamePenerima'] . "/" . $nicknamePengirim . "/" . $bulan . "/" . $tahun;
        $pdf->SetXY(15, 41);
        $pdf->Cell(0, 16, $nomorBA, 0, 0, 'C');

        //tanggal
        $pdf->SetXY(60, 61);
        $pdf->Cell(20, 16, $this->KonversiBulan($bulan) . '     ' . $tahun);

        //data angkutan
        $pdf->SetFontSize(10);
        $pdf->SetXY(53, 82);
        $pdf->Cell(20, 17, $data['ob']['namaKapal'] . " V." . $data['ob']['voy']);
        $pdf->SetXY(53, 88);
        $pdf->Cell(20, 17, date('d-M-Y', strtotime($data['ob']['tanggalTiba'])) );
        $pdf->SetXY(53, 94);
        $pdf->Cell(20, 17, date('d-M-Y', strtotime($data['ob']['tanggalSandar'])) );
        $pdf->SetXY(53, 100);
        $pdf->Cell(20, 17, $data['ob']['noBL']);

        //data pengirim

        $pdf->SetLeftMargin(40);
        $pdf->SetRightMargin(100);
        $pdf->SetXY(50, 115);
        $pdf->Write(5, $data['ob']['namaPengirim']);
        $pdf->SetXY(50, 120);
        $pdf->Write(5, $data['ob']['alamatPengirim']);

        //data penerima
        $pdf->SetLeftMargin(140);
        $pdf->SetRightMargin(10);
        $pdf->SetXY(140, 115);
        $pdf->Write(5, $data['ob']['namaPenerima']);
        $pdf->SetXY(140, 120);
        $pdf->Write(5, $data['ob']['alamatPenerima']);

        //data container
        $i = 0;
        $totalJumlah = NULL;
        $tipeJumlah = NULL;
        $y = 165;
        foreach ($data['container'] as $p) {
            $pdf->SetFontSize(11);
            $pdf->SetLeftMargin(10);
            $pdf->SetRightMargin(10);
            $namaContainer[$i] = explode(" ", $p['noContainer']);
            $pdf->SetXY(20, $y);
            $pdf->Write(5, ($i + 1) . ".");
            $pdf->SetXY(30, $y);
            $pdf->Write(5, $namaContainer[$i][0]);
            $pdf->SetXY(58, $y);
            $pdf->Write(5, $namaContainer[$i][1]);
            $pdf->SetXY(90, $y);
            $pdf->Write(5, $p['seal']);
            $pdf->SetFontSize(9);
            $pdf->SetLeftMargin(115);
            $pdf->SetRightMargin(60);
            $pdf->SetXY(115, $y);
            $pdf->Write(4, $p['isiContainer']);
            $pdf->SetFontSize(12);
            $pdf->SetRightMargin(10);
            $pdf->SetXY(160, $y);
            $pdf->Write(4, $p['jumlah'] . " " . $p['tipeJumlah']);

            $totalJumlah = $totalJumlah + $p['jumlah'];
            $tipeJumlah = $p['tipeJumlah'];
            $i = $i + 1;
            $y = $y + 10;
        }

        $pdf->SetXY(160, 196);
        $pdf->Write(4, $totalJumlah . " " . $tipeJumlah);
        // echo "<pre>", var_dump($namaContainer), "</pre>" ;
        // $namaContainer = explode(" ",$data['container'][]);

        $pdf->Output();
    }

    public function cetakPembayaran($total, $orderpengirim, $nicknamePengirim, $bulan, $tahun)
    {
        $session = $this->session->userdata('nama');
        if(empty($session)){
                redirect(base_url());
        }
        $nomorOB = array('nomorOB' => $total . "/" . $orderpengirim . "/" . $nicknamePengirim . "/" . $bulan . "/" . $tahun);
        $data['ob'] = $this->model->getDataOB($nomorOB);
        $data['container'] = $this->model->getData('rinciancontainer', $nomorOB);
        $data['pembayaran'] = $this->model->getData('rincianbiayaOB', $nomorOB, 'tanggal');

        // echo "<pre>", var_dump($data), "</pre>";

        $pdf = new FPDI('P', 'mm', 'A4');

        $pdf->AddPage();
        $pdf->SetFont('Arial');

        $source = base_url() . "assets/laporan.pdf";
        $fileContent = file_get_contents($source, 'rb');
        $pagecount = $pdf->setSourceFile(StreamReader::createByString($fileContent)); //source of your PDF template
        $tpl = $pdf->importPage(1);
        $pdf->useTemplate($tpl, 1, 1);

        //nomor regist
        $pdf->SetFontSize(10);
        $pdf->SetXY(175, 31);
        $pdf->Write(2, $orderpengirim);

        //rincian ob hingga status bl
        $pdf->SetXY(80, 41);
        $pdf->Write(2, $nomorOB['nomorOB']);
        $pdf->SetFontSize(9);
        $pdf->SetXY(175, 41);
        $pdf->Write(2, date('d/m/Y', strtotime($data['ob']['tanggalOB'])));
        $pdf->SetXY(18, 51);
        $pdf->Write(2, $data['ob']['namaPengirim']);
        $pdf->SetXY(18, 56);
        $pdf->Write(2, $data['ob']['alamatPengirim']);
        $pdf->SetXY(150, 47);
        $pdf->Write(2, $data['ob']['noBL']);
        $pdf->SetXY(150, 52);
        $pdf->Write(2, date('d M Y', strtotime($data['ob']['tanggalBL'])));
        $pdf->SetXY(150, 57);
        $pdf->Write(2, $data['ob']['statusBL']);

        //nama barang hingga penerima
        $pdf->SetXY(75, 67);
        $pdf->Write(2, $data['container'][0]['isiContainer']);
        $pdf->SetXY(75, 71);
        $pdf->Write(2, $data['ob']['ukuranContainer']);

        $pdf->SetXY(175, 67);
        $pdf->Write(2, $data['ob']['namaMandor']);
        $pdf->SetXY(175, 71);
        $pdf->Write(2, $data['ob']['noHpMandor']);

        $x = 75;
        $y = 78;
        foreach ($data['container'] as $c) {
            $pdf->SetXY($x, $y);
            $pdf->Write(2, $c['noContainer']);
            $y = $y + 4;
        }

        $pdf->SetXY(75, 98);
        $pdf->Write(2, $data['ob']['namaKapal']);
        $pdf->SetXY(140, 98);
        $pdf->Write(2, str_pad($data['ob']['voy'], 3, "0", STR_PAD_LEFT));
        $pdf->SetXY(175, 98);
        $pdf->Write(2, date('d M Y', strtotime($data['ob']['tanggalTiba'])));
        $pdf->SetXY(175, 103);
        $pdf->Write(2, date('d M Y', strtotime($data['ob']['tanggalDiterima'])));
        $pdf->SetXY(75, 103);
        $pdf->Write(2, $data['ob']['agentPelayaran']);
        $pdf->SetXY(75, 108);
        $pdf->Write(2, $data['ob']['namaPenerima']);

        $pdf->SetRightMargin(0);

        $y = 128;
        $i = 1;
        $tanggal[0] = 0;
        $cash1 = 0;
        $cash2 = 0;
        $cash3 = 0;
        //isi pembayaran
        foreach ($data['pembayaran'] as $p) {

            if ($tanggal[$i - 1] != $p['tanggal']) {
                $pdf->SetXY(18, $y);
                $pdf->Write(2, date('d-M-Y', strtotime($p['tanggal'])));
            }

            $pdf->SetXY(40, $y);
            $pdf->Write(2, $p['keterangan']);

            if ($p['cash1'] != null) {
                $pdf->SetXY(130, $y);
                $pdf->Write(2, number_format($p['cash1'],0,',','.'));
                $cash1 = $cash1 + $p['cash1'];
            } else if ($p['cash2'] != null) {
                $pdf->SetXY(162, $y);
                $pdf->Write(2, number_format($p['cash2'],0,',','.'));
                $cash2 = $cash2 + $p['cash2'];
            } else if ($p['cash3'] != null) {
                $pdf->SetXY(195, $y);
                $pdf->Write(2, number_format($p['cash3'],0,',','.'));
                $cash3 = $cash3 + $p['cash3'];
            }

            $tanggal[$i] = $p['tanggal'];
            $i = $i + 1;
            $y = $y + 5;
        }

        //Jumlah
        $pdf->SetXY(126, 215);
        $pdf->Write(2, number_format($cash1,0,',','.'));
        $pdf->SetXY(162, 215);
        $pdf->Write(2, number_format($cash2,0,',','.'));
        $pdf->SetXY(195, 215);
        $pdf->Write(2, number_format($cash3,0,',','.'));

        $jumlah = $cash1 + $cash2 + $cash3;
        $pdf->SetXY(126, 225);
        $pdf->Write(2, number_format($jumlah,0,',','.'));

        //nomor debet hingga rugi laba
        $pdf->SetXY(55, 230);
        $pdf->Write(2, $total . "/" . $orderpengirim . "/" . $nicknamePengirim . "/" ."KMM/". $bulan . "/" . $tahun);
        $pdf->SetXY(55, 235);
        $pdf->Write(2, $data['orderbill']['tanggalDebet']);
        $pdf->SetXY(55, 240);
        $pdf->Write(2, $data['orderbill']['jumlahDebet']);

        $pdf->SetXY(160, 240);
        $pdf->Write(2, number_format($data['orderbill']['jumlahDebet'] - $jumlah,0,',','.'));
        $pdf->Output();
    }

    private function KonversiBulan($romawi)
    {
        if ($romawi == 'I') {
            return 'Januari';
        } else if ($romawi == 'II') {
            return "Februari";
        } else if ($romawi == 'III') {
            return "Maret";
        } else if ($romawi == 'IV') {
            return "April";
        } else if ($romawi == 'V') {
            return "Mei";
        } else if ($romawi == 'VI') {
            return "Juni";
        } else if ($romawi == 'VII') {
            return "Juli";
        } else if ($romawi == 'VIII') {
            return "Agustus";
        } else if ($romawi == 'IX') {
            return "September";
        } else if ($romawi == 'X') {
            return "Oktober";
        } else if ($romawi == 'XI') {
            return "November";
        } else if ($romawi == 'XII') {
            return "Desember";
        }
    }
}
