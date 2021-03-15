<?php
    class Login extends CI_Controller{
        public function __construct()
        {
            parent::__construct();
        }

        public function index(){
            
            if(is_null($this->input->post('login'))){
                $data['judul'] = "Login ke Kapuas Mas Mandiri";
                $this->load->view('templates/header',$data);
                $this->load->view('login/index');
            }
            else{
                $this->prosesLogin();
            }

        }

        private function prosesLogin(){
            $this->load->model('login_model','model');

            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $login = array(
                'email' => $email, 
                'password' => $password);

            $user = $this->model->getData('akun',$login);
            
            if($user){
                $dataLogin = array(
                    'nama' => $user['nama'],
                    'jabatan' => $user['jabatan']
                );
                $this->session->set_userdata($dataLogin);
                redirect(base_url('admin'));
            }
            else{
                $this->session->set_flashdata('pesan','Email atau Password Salah!');
                redirect(base_url());
            }

        }
    }
?>