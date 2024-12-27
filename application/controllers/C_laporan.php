
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_transaksi');
        $this->load->library("form_validation");
        $this->load->helper('url');
    }

    public function index() {

       $start_date = $this->input->post('start_date');
       $end_date = $this->input->post('end_date');


       if (!$this->session->userdata('logged_in')) {
        redirect('C_login', 'refresh');
    }

    $data['username'] = $this->session->userdata('logged_in')['username'];
    $data['title'] = 'Laporan Transaksi';

    $this->load->view('template/headbar', $data);
    $this->load->view('V_filter_laporan', $data);
    $this->load->view('template/footbarend', $data);
    $this->load->view('template/footbar', $data); }

    public function hasil_laporan() {
        if (!$this->session->userdata('logged_in')) {
            redirect('C_login', 'refresh');
        }

        $start_date = $this->input->post('start_date', true);
        $end_date = $this->input->post('end_date', true);
            // Query untuk mengambil laporan
        $this->db->where('tanggal_transaksi >=', $start_date);
        $this->db->where('tanggal_transaksi <=', $end_date);
        $laporan = $this->db->get('transaksi')->result_array();



        $data['username'] = $this->session->userdata('logged_in')['username'];
        $data['title'] = 'Hasil Laporan Transaksi';
        $data['laporan'] = $this->M_transaksi->get_laporan_transaksi_by_nama_obat($start_date, $end_date);
        $data['start_date'] = $start_date;  
        $data['end_date'] = $end_date;  

        $this->load->view('template/headbar', $data);
        $this->load->view('V_hasil_laporan', $data);
        $this->load->view('template/footbarend', $data);
        $this->load->view('template/footbar', $data);
    }



    public function lihat_detail($id = null)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('C_login', 'refresh');
        }

        if ($id === null) {
            redirect('C_laporan');
        }
        $data['username'] = $this->session->userdata('logged_in')['username'];
        $data['detail'] = $this->M_transaksi->get_detail($id);
        $this->load->view('template/headbar', $data);
        $this->load->view('lihat_detail', $data);
        $this->load->view('template/footbarend', $data);
        $this->load->view('template/footbar', $data);
    }

    public function cetak_struk($id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('C_login', 'refresh');
        }

        $data['username'] = $this->session->userdata('logged_in')['username'];
        $detail = $this->M_transaksi->get_detail($id);
        $data['detail'] = $detail;
        $this->load->view('template/headbar', $data);
        $this->load->view('cetak_struk', $data);
        $this->load->view('template/footbarend', $data);
        $this->load->view('template/footbar', $data);
    }

    public function struk_pdf($id) {
        $this->load->library('dompdf_gen');

        $data['detail'] = $this->M_transaksi->get_detail($id);
        $html = $this->load->view('master/struk_pdf', $data, true);

        $options = new Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf\Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("struk_pembelian.pdf", ["Attachment" => false]);
    }

    public function delete_laporan($id = null)
    {
    // Pastikan user sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('C_login', 'refresh');
        }

    // Jika nama tidak diberikan, redirect ke halaman laporan
        if ($id === null) {
            redirect('C_laporan');
        }

    // Menghapus laporan berdasarkan nama
    $this->load->model('M_transaksi');  // Pastikan model sudah dipanggil
    $this->M_transaksi->delete_laporan($id);

    // Set flash message untuk konfirmasi
    $this->session->set_flashdata('message', 'Laporan berhasil dihapus');
    redirect('C_laporan');
}
}



