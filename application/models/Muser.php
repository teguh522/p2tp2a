<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Muser extends CI_Model
{

    function create_data($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }

    function pagedata($limit, $offset, $coloum, $where, $tabel)
    {
        $this->db->select('*');
        $this->db->from($tabel);
        $this->db->where($coloum, $where);
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    function get_data($coloum, $where, $tabel)
    {
        $this->db->where($coloum, $where);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->row();
        }
        return null;
    }


    function get_kasuspertahun($tahun)
    {
        $data = $this->db->query("select * from tbl_kecamatan a left join totalpertahun b 
        on a.id_kecamatan=b.id_kecamatan where tahun='{$tahun}'
        ");
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function printlaporanadmin($id)
    {
        $data = $this->db->query("SELECT * FROM tbl_pengaduan as a left join tbl_kecamatan as b
        on a.id_kecamatan=b.id_kecamatan
        left join tbl_jenis_kasus as c on a.jenis_kasus=c.id_kasus
        where id_pengaduan={$id}
        ");
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }

    function get_perjeniskasus($tahun)
    {
        $data = $this->db->query("SELECT a.id_kasus,a.nama_kasus,COUNT(b.jenis_kasus) as totalkasus,
        year(b.tgl_kejadian) as tahun FROM `tbl_jenis_kasus` a  LEFT join tbl_pengaduan b on a.id_kasus=b.jenis_kasus 
        where year(b.tgl_kejadian)='{$tahun}'
        GROUP by a.id_kasus,a.nama_kasus,b.jenis_kasus,year(b.tgl_kejadian)");
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_perjeniskasustotal()
    {
        $data = $this->db->query("SELECT a.id_kasus,a.nama_kasus,COUNT(b.jenis_kasus) as totalkasus,
        COUNT(if(b.jk='wanita',1,null))as wanita,
        COUNT(if(b.jk='pria',1,null))as pria,
        year(b.tgl_kejadian) as tahun FROM `tbl_jenis_kasus` a  LEFT join tbl_pengaduan b on a.id_kasus=b.jenis_kasus 
        GROUP by a.id_kasus,a.nama_kasus,b.jenis_kasus,year(b.tgl_kejadian)");
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_all($tabel, $orderby, $conf)
    {
        $this->db->order_by($orderby, $conf);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_all_join($tabel, $tabel2, $join, $orderby, $conf)
    {
        $this->db->join($tabel2, $join);
        $this->db->order_by($orderby, $conf);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }

    function get_data_join_str($coloum, $where, $tabel, $tabel2, $join, $orderby, $conf)
    {
        $this->db->join($tabel2, $join);
        $this->db->where($coloum, $where);
        $this->db->order_by($orderby, $conf);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_join_str2($coloum, $where, $coloum2, $where2, $tabel, $tabel2, $join)
    {
        $this->db->join($tabel2, $join);
        $this->db->where($coloum, $where);
        $this->db->where($coloum2, $where2);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_twojoin($samecoloum, $tabel1, $tabel2)
    {
        $this->db->join($tabel2, $samecoloum);
        $data = $this->db->get($tabel1);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_twojoinrow($samecoloum, $coloum, $where, $tabel1, $tabel2)
    {
        $this->db->join($tabel2, $samecoloum);
        $this->db->where($coloum, $where);
        $data = $this->db->get($tabel1);
        if ($data->num_rows() > 0) {
            return $data->row();
        }
        return null;
    }

    function get_threejoin($samecoloum, $samecoloum2, $tabel1, $tabel2, $tabel3)
    {
        $this->db->join($tabel2, $samecoloum);
        $this->db->join($tabel3, $samecoloum2);
        $data = $this->db->get($tabel1);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }

    function get_data_allarray($coloum, $where, $tabel)
    {
        $this->db->where($coloum, $where);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }

    function update_data($coloum, $where, $data, $tabel)
    {
        $this->db->where($coloum, $where);
        $this->db->update($tabel, $data);
    }
    function delete($coloum, $where, $tabel)
    {
        $this->db->where($coloum, $where);
        $this->db->delete($tabel);
    }
}
