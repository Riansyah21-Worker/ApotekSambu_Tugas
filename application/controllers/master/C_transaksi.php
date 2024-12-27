


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("M_transaksi"); 
        $this->load->model('master/M_obat');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index() {
        $session_data = $this->session->userdata('logged_in');
        if ($session_data) {
            $data['username'] = $session_data['username'];
            $data['title'] = 'Transaksi';
            $data['dtobat'] = $this->M_transaksi->get_obat(); 
            $data['dtransaksi'] = $this->M_transaksi->get_transaksi_limit();
            $this->load->view('V_transaksi', $data);
        } else {
            redirect('C_login', 'refresh');
        }
    }

    public function get_harga_satuan()
    {
        $nama_obat = $this->input->post('obat_id'); 
        if (!$nama_obat) {
            echo json_encode(['status' => 'error', 'message' => 'Nama obat tidak valid']);
            return;
        }

        $obat = $this->M_obat->get_obat_by_name($nama_obat);

        if ($obat) {
            echo json_encode(['status' => 'success', 'harga_satuan' => $obat->harga_satuan]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Obat tidak ditemukan']);
        }


    }


    public function simpan()
    {
        $this->load->model('M_obat');

    // Mengambil data dari form
        $nama = $this->input->post('nama');
        $keluhan = $this->input->post('keluhan');
        $id_obat = $this->input->post('obat'); 
        $pcs = $this->input->post('pcs');
        $id_supplier = $this->input->post('supplier');

        $nama_obat = $this->M_obat->get_obat_by_name($id_obat);


        if (!$nama_obat) {
            $this->session->set_flashdata('error', 'Obat tidak ditemukan!');
            redirect('master/C_transaksi');
            return;
        }

    // Menghapus simbol Rp dan titik sebelum menyimpan ke database
        $harga_satuan = str_replace(['Rp', '.'], '', $this->input->post('harga_satuan'));
        $total_harga = str_replace(['Rp', '.'], '', $this->input->post('total_harga')); 
        $harga_satuan = intval($harga_satuan);
        $total_harga = intval($total_harga);

        $data = [
            'nama' => $nama,
            'keluhan' => $keluhan,
            'obat' => $nama_obat, 
            'jumlah_pcs' => $pcs,
            'harga_satuan' => $harga_satuan,
            'total_harga' => $total_harga,
            'id_supplier' => $id_supplier  
        ];

        $this->db->insert('transaksi', $data);

        $stok_berkurang = $this->M_obat->kurangi_stok($nama_obat, $pcs); 

        if ($stok_berkurang === false) {

            $this->session->set_flashdata('error', 'Stok tidak cukup untuk obat ' . $nama_obat);
            redirect('master/C_transaksi');
            return;
        }

        $this->session->set_flashdata('success', 'Data berhasil disimpan dan stok berhasil dikurangi!');
        redirect('master/C_transaksi');
    }

}
