
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function get_obat($nama = null)
    {
        if (isset($nama)) {
            $this->db->like('nama', $nama);
            return $this->db->get('obat')->result();
        } else {
            return $this->db->order_by('id', 'ASC')->get('obat')->result();
        }
    }

    public function get_laporan_transaksi_by_nama_obat() {
        $this->db->select('transaksi.id, transaksi.nama, transaksi.keluhan, transaksi.obat, 
           transaksi.jumlah_pcs, transaksi.harga_satuan, transaksi.total_harga, 
           transaksi.tanggal_transaksi, obat.nama_obat');
        $this->db->from('transaksi');
        $this->db->join('obat', 'transaksi.obat = obat.nama_obat', 'inner');
        $this->db->order_by('transaksi.tanggal_transaksi');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function simpan_transaksi($data)
    {
        if (!$this->db->insert('transaksi', $data)) {
        // Debug query error
            log_message('error', $this->db->last_query());
            log_message('error', $this->db->_error_message());
            return false;
        }
        return true;
        
        return $this->db->insert('transaksi', $data);
    }



    // Fungsi untuk mendapatkan transaksi dengan batasan
    public function get_transaksi_limit($limit = 10, $offset = 0) {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('transaksi');
        return $query->result();
    }

    public function get_supplier_by_transaksi($id_transaksi)
    {
        $this->db->select('t.id, o.supplier');
        $this->db->from('transaksi t');
        $this->db->join('obat o', 't.obat = o.nama_obat');
        $this->db->where('t.id', $id_transaksi);

        $query = $this->db->get();

        return $query->row();
    }


    public function get_laporan_pembelian($start_date, $end_date)
    {
        if (empty($start_date) || empty($end_date)) {
        return [];  // Pastikan tanggal valid
    }

    $start_date = date('Y-m-d 00:00:00', strtotime($start_date)); 
    $end_date = date('Y-m-d 23:59:59', strtotime($end_date));   

    $this->db->select('transaksi.id, transaksi.nama, transaksi.keluhan, 
        transaksi.tanggal_transaksi, obat.nama_obat');
    $this->db->from('transaksi');
    $this->db->join('obat', 'transaksi.obat = obat.id', 'inner'); 
    $this->db->where('transaksi.tanggal_transaksi >=', $start_date);  
    $this->db->where('transaksi.tanggal_transaksi <=', $end_date);   
    $this->db->order_by('transaksi.tanggal_transaksi', 'ASC'); 

    $query = $this->db->get();

    return $query->num_rows() > 0 ? $query->result_array() : [];
}


public function get_detail($id)
{
    $this->db->where('id', $id);
    return $this->db->get('transaksi')->row_array();
}

public function delete_laporan($id)
{
    // Menghapus laporan berdasarkan nama
    $this->db->where('id', $id);
    $this->db->delete(' transaksi');
}


}

