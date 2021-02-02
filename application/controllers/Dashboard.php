<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Muser');
        if (($this->session->userdata('id_login') == null) && ($this->session->userdata('status') == null)) {
            $this->session->sess_destroy();
            redirect('auth', 'refresh');
        }
        if ($this->session->userdata('level') == 'admin') {
            redirect('admin', 'refresh');
        }
    }
    public function index()
    {
        $id = $this->session->userdata('id_login');
        $hasil['data'] = $this->Muser->get_data('id_user', $id, 'datautama');

        $this->load->view('vheaderlogin');
        $this->load->view('vmenu', $hasil);
        $this->load->view('user/vdashboard');
        $this->load->view('vfooterlogin');
    }
}
