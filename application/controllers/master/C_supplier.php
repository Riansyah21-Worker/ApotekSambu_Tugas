<?php

class C_supplier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->model("master/M_supplier");
    }

    public function index()
    {
        $session_data = $this->session->userdata('logged_in');
        
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['password'] = $session_data['password'];
            $data['Titel'] = 'Dashboard';
            $data['dtsupplier'] = $this->M_supplier->get_supplier();
            $data['dtpersonil'] = $data['username'];
            $aksi = $this->uri->segment(4);

            $supplier = $this->input->post('supplier');
            $updated_by = $this->input->post('updated_by');

            if ($aksi == 'simpan') {
                $cek_supplier = $this->M_supplier->cek_supplier($supplier);

                if ($cek_supplier->num_rows() > 0) {
                    // Jika supplier sudah ada
                    $data['message'] = 'Supplier <strong>' .  $supplier . '</strong> sudah ada!';
                    $this->load->view('master/V_supplier', array_merge($data));
                } else {
                    // Jika supplier belum ada, simpan data
                    $data_supplier = array(
                        'supplier' => $supplier,
                        'updated_by' => $updated_by
                    );

                    $this->M_supplier->insert_supplier($data_supplier); 
                    echo "<script>alert('Data supplier berhasil disimpan....!!!! ');</script>";
                    redirect('/master/C_supplier', 'refresh');
                }
            }

            $this->load->view('master/V_supplier', array_merge($data)); 
        } else {
            redirect('C_login', 'refresh');
        }
    }

    public function get_supplier_ajax()
    {
        $supplier = $this->M_supplier->get_supplier();
        echo json_encode($supplier);
    }

    // Fungsi update supplier
    public function update()
    {
        $supplier = $this->input->post('supplier');
        $updated_by = $this->input->post('updated_by');

        if (!empty($supplier)) {
            $data_supplier = array(
                'supplier' => $supplier,
                'updated_by' => $updated_by
            );
            $update_result = $this->M_supplier->update_supplier($supplier, $data_supplier);

            if ($update_result) {
                $hasil = array(
                    'status' => 1,
                    'vstatus' => 'berhasil',
                    'pesan' => "Berhasil Update Data Supplier",
                );
            } else {
                $hasil = array(
                    'status' => 0,
                    'vstatus' => 'gagal',
                    'pesan' => "Gagal Update Data Supplier",
                );
            }
            echo json_encode($hasil);
        } else {
            $this->session->set_flashdata('message', "Data supplier tidak ditemukan.");
            redirect('/master/C_supplier', 'refresh');
        }
    }

    public function delete()
    {
        $supplier = $this->input->post('supplier');

        if (!empty($supplier)) {
            // Hapus supplier
            $delete_result = $this->M_supplier->delete_supplier($supplier);

            if ($delete_result) {
                $hasil = array(
                    'status' => 1,
                    'vstatus' => 'berhasil',
                    'pesan' => "Data Supplier Berhasil Dihapus",
                );
            } else {
                $hasil = array(
                    'status' => 0,
                    'vstatus' => 'gagal',
                    'pesan' => "Gagal Hapus Data Supplier",
                );
            }
            echo json_encode($hasil);
        } else {
            $this->session->set_flashdata('message', "Data supplier tidak ditemukan.");
            redirect('/master/C_supplier', 'refresh');
        }
    }
    public function simpan()
    {

        $session_data = $this->session->userdata('logged_in');
        
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['password'] = $session_data['password'];
            $data['Titel'] = 'Dashboard';
            $data['dtpersonil'] = $data['username']; 

            $supplier = $this->input->post('supplier');
            $updated_by = $data['username'];

            $this->form_validation->set_rules('supplier', 'Supplier', 'required|min_length[3]');

            if ($this->form_validation->run() == FALSE) {
                $data['message'] = validation_errors();
                $this->load->view('master/V_supplier', array_merge($data));
            } else {

                $cek_supplier = $this->M_supplier->cek_supplier($supplier);

                if ($cek_supplier->num_rows() > 0) {

                    $data['message'] = 'Supplier <strong>' .  $supplier . '</strong> sudah ada!';
                    $this->load->view('master/V_supplier', array_merge($data));
                } else {

                    $data_supplier = array(
                        'supplier' => $supplier,
                        'updated_by' => $updated_by
                    );


                    $this->M_supplier->insert_supplier($data_supplier);

                    $data['message'] = 'Data supplier berhasil disimpan!';
                    $this->load->view('master/V_supplier', array_merge($data));

                }
            }
        } else {

            redirect('C_login', 'refresh');
        }
    }

}
