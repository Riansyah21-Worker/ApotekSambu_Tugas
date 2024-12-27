<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_supplier extends CI_Model {

    private $tabel = 'obat'; 


    public function get_supplier() {
        $this->db->select('supplier');
        $this->db->from($this->tabel);
        $this->db->distinct(); 
        $query = $this->db->get();
        return $query->result();
    }

    public function cek_supplier($supplier) {
        $this->db->where('supplier', $supplier);
        $query = $this->db->get($this->tabel);
        return $query;
    }

    public function insert_supplier($data_supplier)
    {
    // Menyimpan data ke dalam tabel obat
        $this->db->insert('obat', $data_supplier);
    }



    public function update_supplier($supplier, $data_obat) {
        $this->db->where('supplier', $supplier);
        $this->db->update($this->tabel, $data_obat);
        return $this->db->affected_rows();
    }

    public function delete_supplier($supplier) {
        $this->db->where('supplier', $supplier);
        $query = $this->db->delete($this->tabel);
        return $query;
    }
}

