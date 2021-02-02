<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Muser');
    }
    public function get_kecamatan()
    {
        header('Access-Control-Allow-Origin: *');
        $data['kecamatan'] = $this->Muser->get_kasuspertahun(date('Y'));
        echo json_encode($data);
    }
    public function get_jumlahkasus()
    {
        header('Access-Control-Allow-Origin: *');
        $data['kasus'] = $this->Muser->get_perjeniskasus(date('Y'));
        echo json_encode($data);
    }
}
