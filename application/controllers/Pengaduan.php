<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaduan extends CI_Controller
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
        $func = $this->input->get('func');
        $id_row = $this->input->get('id');

        if ($func == 'updatepengaduan') {
            $data['getrow'] = $this->Muser->get_data('id_pengaduan', $id_row, 'tbl_pengaduan');
            $data['action'] = base_url('pengaduan/update');
        } else {
            $data['action'] = base_url('pengaduan/create');
        }
        $hasil['data'] = $this->Muser->get_data('id_user', $id, 'datautama');
        $data['hasil'] = $this->Muser->get_data_join_str(
            'id_kecamatan',
            $hasil['data']->ka_upt,
            'tbl_pengaduan',
            'tbl_jenis_kasus',
            'tbl_pengaduan.jenis_kasus=tbl_jenis_kasus.id_kasus',
            'id_pengaduan',
            'DESC'
        );
        $data['jenis_kasus'] = $this->Muser->get_data_all('tbl_jenis_kasus', 'id_kasus', 'DESC');
        $this->load->view('vheaderlogin');
        $this->load->view('vmenu', $hasil);
        $this->load->view('user/vpengaduan', $data);
        $this->load->view('vfooterlogin');
    }
    public function create()
    {
        $idkec = $this->input->post('kecamatan');
        $idkasus = $this->input->post('jenis_kasus');
        $namapel = $this->input->post('namapelapor');
        $namakor = $this->input->post('nama_lengkap');
        $kk = $this->input->post('no_kk');
        $kecamatan = $this->Muser->get_data('id_kecamatan', $idkec, 'tbl_kecamatan');
        $kasus = $this->Muser->get_data('id_kasus', $idkasus, 'tbl_jenis_kasus');
        $pesan = "
        Petugas Pelapor : {$namapel} <br>
        Asal Kecamatan : {$kecamatan->nama_kecamatan} <br>
        KK Korban : {$kk} <br>
        Nama Korban : {$namakor}<br>
        Jenis Kasus : {$kasus->nama_kasus}<br>
        <b>Silahkan masuk kesistem untuk melihat detail korban dan segera tindak lanjuti</b>
        ";
        $this->sendemail($pesan);

        $data = array(
            'id_kecamatan' => $idkec,
            'no_kk' => $kk,
            'nama_lengkap' => $namakor,
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'jk' => $this->input->post('jk'),
            'alamat_tinggal' => $this->input->post('alamat_tinggal'),
            'agama' => $this->input->post('agama'),
            'pendidikan' => $this->input->post('pendidikan'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'ibu_kandung' => $this->input->post('ibu_kandung'),
            'alamat' => $this->input->post('alamat'),
            'hp' => $this->input->post('hp'),
            'jenis_kasus' => $idkasus,
            'kronologi' => $this->input->post('kronologi'),
            'tgl_kejadian' => $this->input->post('tgl_kejadian'),
            'keterangan' => "Laporan Terkirm",

        );
        $this->Muser->create_data('tbl_pengaduan', $data);
        $this->session->set_flashdata('msg', 'Berhasil di simpan!');
        redirect('pengaduan');
    }
    function update()
    {
        $id = $this->input->post('id_pengaduan');
        $idkec = $this->input->post('kecamatan');
        $idkasus = $this->input->post('jenis_kasus');
        $namakor = $this->input->post('nama_lengkap');
        $kk = $this->input->post('no_kk');
        $data = array(
            'id_kecamatan' => $idkec,
            'no_kk' => $kk,
            'nama_lengkap' => $namakor,
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'jk' => $this->input->post('jk'),
            'alamat_tinggal' => $this->input->post('alamat_tinggal'),
            'agama' => $this->input->post('agama'),
            'pendidikan' => $this->input->post('pendidikan'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'ibu_kandung' => $this->input->post('ibu_kandung'),
            'alamat' => $this->input->post('alamat'),
            'hp' => $this->input->post('hp'),
            'jenis_kasus' => $idkasus,
            'kronologi' => $this->input->post('kronologi'),
            'tgl_kejadian' => $this->input->post('tgl_kejadian'),
            'keterangan' => "Laporan Terkirm",
        );
        $this->Muser->update_data('id_pengaduan', $id, $data, 'tbl_pengaduan');
        $this->session->set_flashdata('msg', 'Berhasil di Update!');
        redirect('pengaduan');
    }
    public function sendemail($pesan)
    {
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'pengaduan.p2tp2a@gmail.com',  // Email gmail
            'smtp_pass'   => 'B1smillah',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];
        $this->load->library('email', $config);
        $this->email->from('no-reply@pengaduan.p2tp2a@gmail.com', 'Info P2TP2A');
        $this->email->to('martino.uci85@gmail.com');
        $this->email->subject('Notifikasi Kasus Baru');
        $this->email->message($pesan);
        if ($this->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }
    }
    public function delete()
    {
        $func = $this->input->get('func');
        $id = $this->input->get('id');
        if ($func == 'pengaduan') {
            $this->Muser->delete('id_pengaduan', $id, 'tbl_pengaduan');
            $this->session->set_flashdata('msg', 'Terhapus!');
            redirect('pengaduan');
        }
    }
}
