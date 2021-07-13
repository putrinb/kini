<?php
// date_default_timezone_set('Asia/Jakarta');
// echo date('d-m-Y H:i:s'); // Hasil: 20-01-2017 05:32:15
class penerimaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('m_penerimaan');
        $this->load->model('m_bb'); //digunakan untuk melihat id bahanbaku dan nama bahanbaku

    }

    function check_data()
    {
        $tanggal = $this->input->post('tanggal');
        $a_date = date("Y-m-t", strtotime($tanggal)); // tgl akhir bulan
        if($tanggal != $a_date ){
            return TRUE;
           
        } else {
            $this->form_validation->set_message('check_data', 'Bulan yang dipilih sudah terlewati.');
            return FALSE;
        }
    }


    public function add()
    {
        $data['id_penerimaan'] = $this->m_penerimaan->getId(); // ambil id penerimaan
        $data['nama'] = $this->session->userdata('name'); // nama user
        // $data['pembelian'] = $this->m_penerimaan->getIdPembelian(); // ambil id pembelian
        $data['bahanbaku'] = $this->m_penerimaan->getDataBB(); //untuk mengambil data bahanbaku

        $data['heading'] = 'Penerimaan Bahan Baku';
        $data['title'] = 'Kini Cheese Tea | Penerimaan Bahan Baku';
        // $data['satuan'] = ['kilogram (kg)','liter (L)','gram (gr)','ml','piece (pc)','pack','roll'];

        $this->form_validation->set_rules(
            'nm_penerima',
            'nama penerima',
            'required|max_length[20]',
            array(
                'required' => 'Anda harus memasukkan %s.',
                'max_length'    =>  'Maksimal 20 karakter.'
            )
        );

        $this->form_validation->set_rules(
            'tanggal',
            'tanggal penerimaan',
            'required|callback_check_data',
            array('required' => 'Anda harus memasukkan %s.')
        );

        $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('penerimaan/input', $data);
            $this->load->view('templates/footer');
        } else {
            $post = $this->input->post();
            $data['penerimaan'] = array(
                'id_penerimaan' => $this->m_penerimaan->getId(),
                'nm_penerima'   => $this->input->post('nm_penerima'),
                // 'id_pembelian' 	=> $post["id_pembelian"],
                'tanggal'        => $post["tanggal"],
            );

            $_SESSION['id_penerimaan'] = $this->m_penerimaan->getId();
            // $_SESSION['id_pembelian'] = $post["id_pembelian"];
            $_SESSION['tanggal'] = $post["tanggal"];
            $_SESSION['nm_penerima'] = $post["nm_penerima"];

            $data['penerimaan'] = $this->m_penerimaan->getDataDetail($_SESSION['id_penerimaan']);
            $data['ListBB'] = $this->m_penerimaan->getDataBB($_SESSION['id_penerimaan']);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('penerimaan/input_detail', $data);
            // $this->load->view('penerimaan/view_detail',$data);
            $this->load->view('templates/footer');
        }
    }

    //untuk input detail
    public function input_form_detail()
    {
        // $data['IdPenerimaan'] = $this->m_penerimaan->getIdPenerimaan(); // ambil id penerimaan
        $data['pembelian'] = $this->m_penerimaan->getIdPembelian(); // ambil id pembelian
        $data['ListBB'] = $this->m_penerimaan->getDataBB($_SESSION['id_penerimaan']);
        // $data['bahanbaku'] = $this->m_bb->getdata(); //untuk mengambil data bahanbaku
        $data['heading'] = 'Penerimaan Bahan Baku';
        $data['title'] = 'Kini Cheese Tea | Penerimaan Bahan Baku';
        $data['satuan'] = ['kilogram (kg)', 'liter (L)', 'gram (gr)', 'ml', 'piece (pc)', 'pack', 'roll'];

        $this->form_validation->set_rules(
            'nama_bb',
            'nama bahan baku',
            'required',
            array('required' => 'Anda harus memasukkan %s.')
        );

        $this->form_validation->set_rules(
            'keterangan',
            'keterangan produk',
            'max_length[20]',
            array('max_length' => 'Jumlah karakter maksimal 20.')
        );

        $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data['ListBB'] = $this->m_penerimaan->getDataBB($_SESSION['id_penerimaan']);
            $data['penerimaan'] = $this->m_penerimaan->getDataDetail($_SESSION['id_penerimaan']);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('penerimaan/input_detail', $data);
            $this->load->view('penerimaan/view_detail', $data);
            $this->load->view('templates/footer');
        } else {
            //simpan ke database
            $this->m_penerimaan->input_data();
            //dapatkan data hasil penyimpanan
            $data['ListBB'] = $this->m_penerimaan->getDataBB($_SESSION['id_penerimaan']);
            $data['penerimaan'] = $this->m_penerimaan->getDataDetail($_SESSION['id_penerimaan']);

            $data['data_penerimaan'] = $this->m_penerimaan->getDataDetail($_SESSION['id_penerimaan']);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('penerimaan/input_detail', $data);
            $this->load->view('penerimaan/view_detail', $data);
            $this->load->view('templates/footer');
        }
    }

    //ketika sudah selesai menambahkan detail penerimaan
    public function selesai()
    {
        //unset sesi yang digunakan untuk transaksi penerimaan
        unset($_SESSION['id_penerimaan']);
        unset($_SESSION['tanggal']);
        $this->session->set_flashdata('flash', 'tersimpan');
        redirect('penerimaan/view_data');
    }

    public function view_data()
    {
        $data['penerimaan'] = $this->m_penerimaan->getData();
        $data['heading'] = 'Penerimaan Bahan Baku';
        $data['title'] = 'Penerimaan Bahan Baku | Data';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('penerimaan/view_data', $data);
        $this->load->view('templates/footer');
    }

    //fungsi untuk melihat data
    public function view_data_detail($id_penerimaan)
    {
        $data['data_penerimaan'] = $this->m_penerimaan->getDataDetail($id_penerimaan);
        //print_r($data['isi_data']);
        $data['heading'] = 'Detail Penerimaan';
        $data['title'] = 'Penerimaan Bahan Baku | Data';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('penerimaan/view_detail_bb', $data);
        $this->load->view('templates/footer');
    }

    //fungsi untuk menghapus data
    public function delete_data($id_penerimaan, $id_pembelian)
    {

        // if ((!isset($id_penerimaan)) or (!isset($id_pembelian))) show_404();

        if ($this->m_penerimaan->delete_penerimaan($id_penerimaan, $id_pembelian)) {
            $this->session->set_flashdata('flash', 'dihapus');
            redirect(site_url('penerimaan/view_data'));
        }
    }

    //fungsi untuk menghapus data ketika input data detail penerimaan
    public function delete_form_detail($no_penerimaan)
    {
        if ($this->m_penerimaan->deleteFormInputDetailPenerimaan($no_penerimaan)) {
            $this->session->set_flashdata('flash', 'dihapus');
            redirect(site_url('penerimaan/input_form_detail'));
        }
    }
}
