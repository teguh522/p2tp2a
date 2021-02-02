<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Muser');
        if (($this->session->userdata('id_login') == null) && ($this->session->userdata('status') == null)) {
            $this->session->sess_destroy();
            redirect('auth', 'refresh');
        }
        if ($this->session->userdata('level') == 'user') {
            redirect('dashboard', 'refresh');
        }
    }
    public function index()
    {
        $this->load->view('vheaderlogin');
        $this->load->view('vmenu');
        $this->load->view('admin/vlaporan');
        $this->load->view('vfooterlogin');
    }
    public function table()
    {
        $data['hasil'] = $this->Muser->get_perjeniskasustotal();
        $this->load->view('vheaderlogin');
        $this->load->view('vmenu');
        $this->load->view('admin/vtable', $data);
        $this->load->view('vfooterlogin');
    }

    public function get_kecamatan()
    {
        $data['kecamatan'] = $this->Muser->get_kasuspertahun(date('Y'));
        echo json_encode($data);
    }
    public function get_jumlahkasus()
    {
        $data['kasus'] = $this->Muser->get_perjeniskasus(date('Y'));
        echo json_encode($data);
    }
    function pengaduan()
    {
        $func = $this->input->get('func');
        $id_row = $this->input->get('id');

        if ($func == 'updatepengaduan') {
            $data['getrow'] = $this->Muser->get_data('id_pengaduan', $id_row, 'tbl_pengaduan');
            $data['action'] = base_url('admin/pengaduan_update');
        } else {
            $data['action'] = base_url('admin/pengaduan_create');
        }
        $data['hasil'] = $this->Muser->get_data_all_join(
            'tbl_pengaduan',
            'tbl_jenis_kasus',
            'tbl_pengaduan.jenis_kasus=tbl_jenis_kasus.id_kasus',
            'id_pengaduan',
            'DESC'
        );
        $data['kecamatan'] = $this->Muser->get_data_all('tbl_kecamatan', 'id_kecamatan', 'DESC');
        $data['jenis_kasus'] = $this->Muser->get_data_all('tbl_jenis_kasus', 'id_kasus', 'DESC');
        $this->load->view('vheaderlogin');
        $this->load->view('vmenu');
        $this->load->view('admin/vadminpengaduan', $data);
        $this->load->view('vfooterlogin');
    }
    public function pengaduan_create()
    {
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
        $this->Muser->create_data('tbl_pengaduan', $data);
        $this->session->set_flashdata('msg', 'Berhasil di simpan!');
        redirect('admin/pengaduan');
    }
    function pengaduan_update()
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
        redirect('admin/pengaduan');
    }
    function delete()
    {
        $func = $this->input->get('func');
        $id = $this->input->get('id');
        if ($func == 'pengaduan') {
            $this->Muser->delete('id_pengaduan', $id, 'tbl_pengaduan');
            $this->session->set_flashdata('msg', 'Terhapus!');
            redirect('admin/pengaduan');
        }
    }
    public function printlaporan()
    {
        $this->load->library('PDF_MC_Table');
        $id = $this->input->get('idpengaduan');
        $data = $this->Muser->printlaporanadmin($id);
        if ($data == null) {
            echo "Tidak ada data";
        } else {
            $pdf = new PDF_MC_Table('p', 'mm', 'a4');
            $image = base_url('upload/foto/logo.png');
            $pdf->SetTitle('Laporan Rekap');
            $pdf->SetAutoPageBreak(true, 1);
            $pdf->AddPage();
            $pdf->Image($image, 10, 9, 50);
            $pdf->SetFont('Times', '', '14');
            $pdf->Text(65, 17, "Pusat Pelayanan Terpadu Pemberdayaan Perempuan");
            $pdf->Text(65, 22, "dan Anak Sumber Kasih Sayang (P2TP2A) Kabupaten Cirebon");
            $pdf->Line(10, 24, 195, 24);
            $pdf->SetFont('Times', 'B', '14');
            $pdf->Text(11, 30, "DATA P2TP2A SUMBER KASIH SAYANG");
            $pdf->Text(11, 35, "PEDAMPINGAN ANAK KORBAN TINDAK KEKERASAN (AKTK)");
            $pdf->Text(11, 50, "IDENTITAS KORBAN");
            $pdf->SetFont('Times', '', '12');
            $pdf->SetY(55);
            $pdf->Cell(60, 7, "1. Asal Kecamatan", 0, 0, 'L');
            $pdf->Cell(5, 7, ":", 0, 0, 'L');
            $pdf->Cell(50, 7, $data[0]->nama_kecamatan, 0, 1, 'L');
            $pdf->Cell(60, 7, "2. No. KK", 0, 0, 'L');
            $pdf->Cell(5, 7, ":", 0, 0, 'L');
            $pdf->Cell(50, 7, $data[0]->no_kk, 0, 1, 'L');
            $pdf->Cell(60, 7, "3. Nama Lengkap", 0, 0, 'L');
            $pdf->Cell(5, 7, ":", 0, 0, 'L');
            $pdf->Cell(50, 7, $data[0]->nama_lengkap, 0, 1, 'L');
            $pdf->Cell(60, 7, "4. TTL", 0, 0, 'L');
            $pdf->Cell(5, 7, ":", 0, 0, 'L');
            $pdf->Cell(50, 7, $data[0]->tempat_lahir . ", " . date('d M Y', strtotime($data[0]->tgl_lahir)), 0, 1, 'L');
            $pdf->Cell(60, 7, "5. Jenis Kelamin", 0, 0, 'L');
            $pdf->Cell(5, 7, ":", 0, 0, 'L');
            $pdf->Cell(50, 7, $data[0]->jk, 0, 1, 'L');
            $pdf->Cell(60, 7, "6. Alamat Tinggal", 0, 0, 'L');
            $pdf->Cell(5, 7, ":", 0, 0, 'L');
            $pdf->Cell(50, 7, $data[0]->alamat_tinggal, 0, 1, 'L');
            $pdf->Cell(60, 7, "7. Agama", 0, 0, 'L');
            $pdf->Cell(5, 7, ":", 0, 0, 'L');
            $pdf->Cell(50, 7, $data[0]->agama, 0, 1, 'L');
            $pdf->Cell(60, 7, "8. Pendidikan", 0, 0, 'L');
            $pdf->Cell(5, 7, ":", 0, 0, 'L');
            $pdf->Cell(50, 7, $data[0]->pendidikan, 0, 1, 'L');
            $pdf->Cell(60, 7, "9. Pekerjaan", 0, 0, 'L');
            $pdf->Cell(5, 7, ":", 0, 0, 'L');
            $pdf->Cell(50, 7, $data[0]->pekerjaan, 0, 1, 'L');
            $pdf->Cell(60, 7, "10. Ibu Kandung", 0, 0, 'L');
            $pdf->Cell(5, 7, ":", 0, 0, 'L');
            $pdf->Cell(50, 7, $data[0]->ibu_kandung, 0, 1, 'L');
            $pdf->Cell(60, 7, "11. Alamat", 0, 0, 'L');
            $pdf->Cell(5, 7, ":", 0, 0, 'L');
            $pdf->Cell(50, 7, $data[0]->alamat, 0, 1, 'L');
            $pdf->Cell(60, 7, "12. No HP", 0, 0, 'L');
            $pdf->Cell(5, 7, ":", 0, 0, 'L');
            $pdf->Cell(50, 7, $data[0]->hp, 0, 1, 'L');
            $pdf->Cell(60, 7, "13. Jenis Kasus", 0, 0, 'L');
            $pdf->Cell(5, 7, ":", 0, 0, 'L');
            $pdf->Cell(50, 7, $data[0]->nama_kasus, 0, 1, 'L');
            $pdf->Cell(60, 7, "14. Kronologi", 0, 0, 'L');
            $pdf->Cell(5, 7, ":", 0, 0, 'L');
            $pdf->Cell(50, 7, $data[0]->kronologi, 0, 1, 'L');
            $pdf->Cell(60, 7, "15. Tgl Kejadian", 0, 0, 'L');
            $pdf->Cell(5, 7, ":", 0, 0, 'L');
            $pdf->Cell(50, 7, date('d M Y', strtotime($data[0]->tgl_kejadian)), 0, 1, 'L');
            $pdf->SetFont('Times', 'B', '14');
            $pdf->Text(11, 170, "TINDAK LANJUT PENANGANAN KASUS");
            $pdf->SetY(175);
            $pdf->Cell(190, 50, "", 1, 0, 'L');
            $pdf->Text(11, 235, "FOTO KORBAN");
            $pdf->SetXY(15, 245);
            $pdf->Cell(20, 20, "", 1, 0, 'L');
            $pdf->Output();
        }
    }
}
