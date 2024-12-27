
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_obat extends CI_Model {

    private $tabel = 'obat';

    public function get_obat() {
        $this->db->select('*');
        $this->db->from($this->tabel);
        $query = $this->db->get();
        return $query->result();
    }

    public function cek_obat($nama_obat, $supplier) {
        $this->db->where('nama_obat', $nama_obat);
        $this->db->where('supplier', $supplier);
        $query = $this->db->get($this->tabel);
        return $query;
    }



    public function insert_dtobat($data_obat) {
        $this->db->insert($this->tabel, $data_obat);
    }

    function update_dtobat($id, $data_obat)
    {
        $this->db->trans_begin();
        $this->db->where('id', $id);
        $this->db->update('obat', $data_obat);
        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            $result = 0;
        } else {
            $this->db->trans_commit();
            $result = 1;
        }
        return $result;
        return TRUE;
    }

    function delete_obat($id)
    {
        $query = $this->db->delete('obat', "id = '$id'");
        return $query;
    }

    // Fungsi untuk mendapatkan supplier
    public function get_supplier() {
        $this->db->select('supplier');
        $this->db->from($this->tabel);
        $this->db->distinct();
        $query = $this->db->get();
        return $query->result();
    }


    public function get_stock($id_obat) {
        $this->db->select('stock');
        $this->db->where('id', $id_obat);
        $query = $this->db->get('obat');
        $result = $query->row();

        return $result ? (int)$result->stock : 0;
    }

    public function get_obat_by_name($id_obat)
    {
        $this->db->select('nama_obat, supplier');
    $this->db->from('obat'); // Nama tabel obat
    $this->db->where('id', $id_obat);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row()->nama_obat; 
    } else {
        return null;
    }
}


    // Kurangi stok berdasarkan nama_obat
public function kurangi_stok($nama_obat, $jumlah_pcs)
{

    $this->db->select('stock');
    $this->db->from('obat');
    $this->db->where('nama_obat', $nama_obat);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $stok = $query->row()->stock; 

        if ($stok < $jumlah_pcs) {
            return false; 
        }

        // Update stok obat
        $stok_baru = $stok - $jumlah_pcs;
        $this->db->where('nama_obat', $nama_obat);
        $this->db->update('obat', ['stock' => $stok_baru]);

        return $stok_baru; 
    } else {
        return false; 
    }
}

}
