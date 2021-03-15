<?php
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('database_model', 'model');
    }

    public function index()
    {
        $session = $this->session->userdata('nama');
        if(empty($session)){
                redirect(base_url());
        }
        $data['judul'] = "Halaman Admin";
        $data['jam'] = $this->jam();
        $db = array(
            'OB' => count($this->model->getData('orderbill')),
            'penerima' => count($this->model->getData('penerima')),
            'pengirim' => count($this->model->getData('pengirim'))
        );

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/dashboard',$db);
        $this->load->view('templates/footer');
    }

    public function orderbill(){
        $session = $this->session->userdata('nama');
        if(empty($session)){
                redirect(base_url());
        }
        $data['judul'] = "Order Bill";
        $db = $this->model->getDataOB();
        $data['orderbill'] = $db;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/orderbill');
        $this->load->view('templates/footer');
    }

    public function detailOB($nomorOB,$nomor2,$kodePengirim,$bulan,$tahun){
        $session = $this->session->userdata('nama');
        if(empty($session)){
                redirect(base_url());
        }

        $nomorOB = array("nomorOB" => $nomorOB."/".$nomor2."/".$kodePengirim."/".$bulan."/".$tahun);
        
        $data['judul'] = "Order Bill";
        $data['pengirim'] = $this->model->getData('pengirim');
        $data['penerima'] = $this->model->getData('penerima');
        $data['pembayaran'] = $this->model->getData('rincianbiayaOB',$nomorOB,"tanggal ASC");
        $data['container'] = $this->model->getData('rinciancontainer',$nomorOB);

        $db = $this->model->getDataOB($nomorOB);
        $data['orderbill'] = $db;
        // var_dump($db);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/detailOB');
        $this->load->view('templates/footer');
    }

    public function tambahOrderBill(){
        $session = $this->session->userdata('nama');
        if(empty($session)){
                redirect(base_url());
        }

        $data['judul'] = "Tambah Order Bill";

        $data['pengirim'] = $this->model->getData('pengirim');
        $data['penerima'] = $this->model->getData('penerima');
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/tambahOrderBill');
        $this->load->view('templates/footer');
    }

    public function editOB($nomorOB,$nomor2,$kodePengirim,$bulan,$tahun){
        $session = $this->session->userdata('nama');
        if(empty($session)){
                redirect(base_url());
        }

        $nomorOB = array("nomorOB" => $nomorOB."/".$nomor2."/".$kodePengirim."/".$bulan."/".$tahun);

        $data['judul'] = "Edit Order Bill ".$nomorOB['nomorOB'];
        $data['pengirim'] = $this->model->getData('pengirim');
        $data['penerima'] = $this->model->getData('penerima');

        $db = $this->model->getDataOB($nomorOB);
        $data['orderbill'] = $db;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/editOB');
        $this->load->view('templates/footer');
        
    }

    public function penerima()
    {
        $session = $this->session->userdata('nama');
        if(empty($session)){
                redirect(base_url());
        }

        $data['judul'] = "List Penerima";
        $db = $this->model->getData('penerima');
        $data['penerima'] = $db;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/penerima');
        $this->load->view('templates/footer');
    }

    public function pengirim()
    {
        $session = $this->session->userdata('nama');
        if(empty($session)){
                redirect(base_url());
        }

        $data['judul'] = "List Pengirim";
        $db = $this->model->getData('pengirim');
        $data['pengirim'] = $db;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/pengirim');
        $this->load->view('templates/footer');
    }

    public function tambah($tabel){
        $session = $this->session->userdata('nama');
        if(empty($session)){
                redirect(base_url());
        }

        if($tabel == 'penerima'){
            $data = array(
                'namaPenerima' => strtoupper($this->input->post('nama')),
				'alamatPenerima' => strtoupper($this->input->post('alamat')),
				'nicknamePenerima' => strtoupper($this->input->post('nickname'))
            );
            $this->model->tambahData($tabel,$data);
            
            $this->session->set_flashdata('pesan', 'Penerima berhasil ditambahkan!');
            redirect(base_url('admin/penerima'));
        }

        else if($tabel == 'pengirim'){
            $data = array(
                'namaPengirim' => strtoupper($this->input->post('nama')),
				'alamatPengirim' => strtoupper($this->input->post('alamat')),
				'nicknamePengirim' => strtoupper($this->input->post('nickname'))
            ); 
            $cek = $this->model->tambahData($tabel,$data);
            if(!$cek){
                $this->session->set_flashdata('pesan', $this->db->error());
            }

            $this->session->set_flashdata('pesan', 'Pengirim berhasil ditambahkan!');
            redirect(base_url('admin/pengirim'));
        }

        else if($tabel == 'OB'){
            // $serial = $this->model->cekSequence();
            $data = array(
                'nomorOB' => strtoupper($this->input->post('nomorOB')),
                'tanggalOB' => $this->input->post('tanggalOB'),
                'pengirim' => $this->input->post('namaPengirim'),
                'penerima' => $this->input->post('namaPenerima'),
                'namaKapal' => strtoupper($this->input->post('namaKapal')),
                'voy' => strtoupper($this->input->post('voy'))
            );

            $this->model->tambahData('orderbill',$data);

            $this->session->set_flashdata('pesan', 'Orderbill berhasil ditambahkan!');
            redirect(base_url('admin/orderbill'));
        }

        else if($tabel == 'container'){
            $data = array(
                'nomorOB' => strtoupper($this->input->post('nomorOB')),
                'noContainer' => strtoupper($this->input->post('noContainer')),
                'isiContainer' => $this->input->post('isiContainer'),
                'seal' => $this->input->post('seal'),
                'jumlah' => $this->input->post('jumlah'),
                'tipeJumlah' => $this->input->post('tipeJumlah')
            );

            $this->model->tambahData('rinciancontainer',$data);

            $this->session->set_flashdata('pesan', 'Container berhasil ditambahkan!');
            redirect(base_url('admin/detailOB/').$this->input->post('nomorOB'));
        }

        else if($tabel == 'pembayaran'){
            if($this->input->post('tipecash') == "cash1"){
                $cash1 = $this->input->post('cash');
                $cash2 = null;
                $cash3 = null;
            }
            else if($this->input->post('tipecash') == "cash2"){
                $cash2 = $this->input->post('cash');
                $cash1 = null;
                $cash3 = null;
            }
            else if($this->input->post('tipecash') == "cash3"){
                $cash3 = $this->input->post('cash');
                $cash1 = null;
                $cash2 = null;
            }

            $data = array(
                'nomorOB' => strtoupper($this->input->post('nomorOB')),
                'tanggal' => $this->input->post('tanggal'),
                'keterangan' => $this->input->post('keterangan'),
                'cash1' => $cash1,
                'cash2' => $cash2,
                'cash3' => $cash3
            );

            $this->model->tambahData('rincianbiayaOB',$data);
            
            $this->session->set_flashdata('pesan', 'Biaya berhasil ditambahkan!');
            redirect(base_url('admin/detailOB/').$this->input->post('nomorOB'));

        }
    }

    public function edit($tabel){
        $session = $this->session->userdata('nama');
        if(empty($session)){
                redirect(base_url());
        }

        if($tabel == "pengirim"){
            $id = array(
                'idPengirim' => $this->input->post('idPengirim')
            );
            $data = array(
                'namaPengirim' => strtoupper($this->input->post('namaPengirim')),
                'alamatPengirim' => strtoupper($this->input->post('alamatPengirim')),
                'nicknamePengirim' => strtoupper($this->input->post('nicknamePengirim'))
            );

            $this->model->editData($id,'pengirim',$data);

            $this->session->set_flashdata('pesan', 'Pengirim berhasil diedit!');
            redirect(base_url('admin/pengirim'));
        }
        
        else if($tabel == "penerima"){
            $id = array(
                'idPenerima' => $this->input->post('idPenerima')
            );
            $data = array(
                'namaPenerima' => strtoupper($this->input->post('namaPenerima')),
                'alamatPenerima' => strtoupper($this->input->post('alamatPenerima')),
                'nicknamePenerima' => strtoupper($this->input->post('nicknamePenerima'))
            );

            $this->model->editData($id,'penerima',$data);

            $this->session->set_flashdata('pesan', 'Penerima berhasil diedit!');
            redirect(base_url('admin/penerima'));
        }
        else if($tabel == "OB"){
            $id = array(
                'nomorOB' => $this->input->post('nomorOB')
            );

            $data = array(
                'namaKapal' => strtoupper($this->input->post('namaKapal')),
                'voy' =>  $this->input->post('voy'),
                'tanggalTiba' => strtoupper($this->input->post('tanggalTiba')),
                'tanggalSandar' => $this->input->post('tanggalSandar'),
                'tanggalOB' => $this->input->post('tanggalOB'),
                'ukuranContainer' => strtoupper($this->input->post('ukuranContainer')),
                'agentPelayaran' => strtoupper($this->input->post('agentPelayaran')),
                'pengirim' => strtoupper($this->input->post('namaPengirim')),
                'penerima' => strtoupper($this->input->post('namaPenerima')),
                'noBL' => strtoupper($this->input->post('noBL')),
                'tanggalBL' => strtoupper($this->input->post('tanggalBL')),
                'tanggalDiterima' => strtoupper($this->input->post('tanggalDiterima')),
                'namaMandor' => strtoupper($this->input->post('namaMandor')),
                'noHpMandor' => strtoupper($this->input->post('noHpMandor')),
                'statusBL' => strtoupper($this->input->post('statusBL'))
            );

            // echo "<pre>",var_dump($data),"</pre>";

            $this->model->editData($id,'orderbill',$data);

            $this->session->set_flashdata('pesan', 'Orderbill berhasil diedit!');
            redirect(base_url('admin/detailOB/').$id['nomorOB']);
        }
        else if($tabel == "container"){
            $id = array(
                'nomorOB' => $this->input->post('nomorOB'),
                'noContainer' =>$this->input->post('noContainerSebelum')
            );

            $data = array(
                'noContainer' => $this->input->post('noContainer'),
                'seal' => $this->input->post('seal'),
                'isiContainer' => $this->input->post('isiContainer'),
                'jumlah' => $this->input->post('jumlah'),
                'tipeJumlah' => $this->input->post('tipeJumlah')
            );

            echo "<pre>",var_dump($data),"</pre>";

            $this->model->editData($id,'rinciancontainer',$data);

            $this->session->set_flashdata('pesan', 'Data Container berhasil diedit!');
            redirect(base_url('admin/detailOB/').$id['nomorOB']);
        }
        else if($tabel == "pembayaran"){
            $id = array(
                'nomorOB' => $this->input->post('nomorOB'),
                'id' => $this->input->post('id')
            );

            if($this->input->post('tipecash') == "cash1"){
                $cash1 = $this->input->post('cash');
                $cash2 = null;
                $cash3 = null;
            }
            else if($this->input->post('tipecash') == "cash2"){
                $cash2 = $this->input->post('cash');
                $cash1 = null;
                $cash3 = null;
            }
            else if($this->input->post('tipecash') == "cash3"){
                $cash3 = $this->input->post('cash');
                $cash1 = null;
                $cash2 = null;
            }

            $data = array(
                //noContainer
                'tanggal' => $this->input->post('tanggal'),
                'keterangan' => $this->input->post('keterangan'),
                'cash1' => $cash1,
                'cash2' => $cash2,
                'cash3' => $cash3
            );

            $this->model->editData($id,'rincianbiayaOB',$data);
            $this->session->set_flashdata('pesan', 'Data Pembayaran berhasil diedit!');
            redirect(base_url('admin/detailOB/').$id['nomorOB']);
        }
    }

    public function delete($tabel,$id = null){
        $session = $this->session->userdata('nama');
        if(empty($session)){
                redirect(base_url());
        }

        if($tabel == "pengirim"){
            $id = array(
                'idPengirim' => $id
            );
            $this->model->deleteData('pengirim',$id);

            $this->session->set_flashdata('pesan', 'Pengirim berhasil dihapus!');
            redirect(base_url('admin/pengirim'));
        }
        else if($tabel == "penerima"){
            $id = array(
                'idPenerima' => $id
            );

            $this->model->deleteData('penerima',$id);

            $this->session->set_flashdata('pesan', 'Penerima berhasil dihapus!');
            redirect(base_url('admin/penerima'));
        }
        else if($tabel == "OB"){

        }
        else if($tabel == "container"){
            $id = array(
                'nomorOB' => $this->input->post('nomorOB'),
                'noContainer' => $this->input->post('noContainer')
            );

            // echo "<pre>",var_dump($id),"</pre>";
            $this->model->deleteData('rinciancontainer',$id);

            $this->session->set_flashdata('pesan', 'Data Container berhasil dihapus!');
            redirect(base_url('admin/detailOB/').$id['nomorOB']);
        }
        else if($tabel == "pembayaran"){
            $id = array(
                'nomorOB' => $this->input->post('nomorOB'),
                'id' => $this->input->post('id')
            );

            $this->model->deleteData('rincianbiayaOB',$id);

            $this->session->set_flashdata('pesan', 'Data Pembayaran berhasil dihapus!');
            redirect(base_url('admin/detailOB/').$id['nomorOB']);
        }
    }

    public function logout()
    {
        $data = array('nama', 'jabatan');
        $this->session->unset_userdata($data);
        $this->session->set_flashdata('pesan', 'Anda berhasil Logout!');
        redirect(base_url());
    }

    private function jam()
    {
        date_default_timezone_set('Asia/Jakarta');
        $Hour = date('G');

        if ($Hour >= 5 && $Hour <= 11) {
            return "Selamat Pagi";
        } else if ($Hour >= 12 && $Hour <= 14) {
            return "Selamat Siang";
        } elseif ($Hour >= 15 && $Hour <= 17) {
            return "Selamat Sore";
        } else if ($Hour >= 18 || $Hour <= 4) {
            return "Selamat Malam";
        }
    }
}
