<?php
class bom extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('m_bom');
        $this->load->model('m_bb'); //digunakan untuk melihat id bahanbaku dan nama bahanbaku
        // if(!$this->session->userdata('is_logged')){
        // 	redirect('auth');
        // }
    }

    public function add()
    {
        $data['id_bom'] = $this->m_bom->getId(); // ambil id penerimaan
        $data['minuman'] = $this->m_bom->getIdMinuman(); // ambil id pembelian
        $data['bahanbaku'] = $this->m_bb->getdata2(); //untuk mengambil data bahanbaku
        // $data['penolong'] = $this->m_bom->getBahanPenolong();
        $data['heading'] = 'Bill of Material';
        $data['title'] = 'Kini Cheese Tea | Bill of Material';
        $data['satuan'] = ['gram (gr)', 'ml'];

        $this->form_validation->set_rules(
            'id_produk',
            'nama produk',
            'required',
            array('required' => 'Anda harus memasukkan %s.')
        );

        $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('bom/input_bom', $data);
            $this->load->view('templates/footer');
        } else {
            $post = $this->input->post();
            $data['data_bom'] = array(
                'id_bom' => $this->m_bom->getId(),
                'id_produk'     => $this->input->post('id_produk'),
            );
            // $this->m_bom->input_data();

            $_SESSION['id_bom'] = $this->input->post('id_bom');
            $_SESSION['id_produk'] = $post["id_produk"];

            $data['data_bom'] = $this->m_bom->getDataDetail($_SESSION['id_bom'], $_SESSION['id_produk']);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('bom/input_detail', $data);
            // $this->load->view('bom/view_detail', $data);
            $this->load->view('templates/footer');
        }
    }

    //untuk input detail
    public function input_form_detail()
    {
        // $data['IdPenerimaan'] = $this->m_bom->getIdPenerimaan(); // ambil id penerimaan
        $data['minuman'] = $this->m_bom->getIdMinuman(); // ambil id pembelian
        $data['bahanbaku'] = $this->m_bb->getdata2(); //untuk mengambil data bahanbaku
        // $data['penolong'] = $this->m_bom->getBahanPenolong();
        $data['heading'] = 'Bill of Material';
        $data['title'] = 'Kini Cheese Tea | Bill of Material';
        $data['satuan'] = ['gram (gr)', 'ml'];

        $this->form_validation->set_rules(
            'nama_bb',
            'nama bahan baku',
            'required',
            array('required' => 'Anda harus memasukkan %s.')
        );

        $this->form_validation->set_rules(
            'qty',
            'jumlah',
            'required',
            array('required' => 'Anda harus memasukkan %s.')
        );

        $this->form_validation->set_rules(
            'satuan',
            'satuan',
            'required',
            array('required' => 'Anda harus memasukkan %s.')
        );

        $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data['data_bom'] = $this->m_bom->getDataDetail($_SESSION['id_bom'], $_SESSION['id_produk']);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('bom/input_detail', $data);
            $this->load->view('bom/view_detail', $data);
            $this->load->view('templates/footer');
        } else {
            //simpan ke database
            $this->m_bom->input_data();
            $data['bahanbaku'] = $this->m_bb->getdata2();
            //dapatkan data hasil penyimpanan
            $data['bom'] = $this->m_bom->getDataDetail($_SESSION['id_bom'], $_SESSION['id_produk']);

            $data['data_bom'] = $this->m_bom->getDataDetail($_SESSION['id_bom'], $_SESSION['id_produk']);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('bom/input_detail', $data);
            $this->load->view('bom/view_detail', $data);
            $this->load->view('templates/footer');
        }
    }

    //ketika sudah selesai menambahkan detail bom
    public function selesai()
    {
        //unset sesi yang digunakan untuk bom
        unset($_SESSION['id_bom']);
        unset($_SESSION['id_produk']);
        $this->session->set_flashdata('flash', 'tersimpan');
        redirect('bom/view_data');
    }

    public function view_data()
    {
        $data['data_bom'] = $this->m_bom->getData();
        $data['heading'] = 'Bill of Material';
        $data['title'] = 'Bill of Material | Data';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bom/view_data', $data);
        $this->load->view('templates/footer');
    }

    //fungsi untuk melihat data
    public function view_data_detail($id_bom, $id_produk)
    {
        $data['data_bom'] = $this->m_bom->getDataDetail($id_bom, $id_produk);
        //print_r($data['isi_data']);
        $data['heading'] = 'Detail BOM';
        $data['title'] = 'Bill of Material | Data';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bom/view_detail_bb', $data);
        $this->load->view('templates/footer');
    }

    //fungsi untuk menghapus data
    public function delete_data($id_bom, $id_produk)
    {
        // if ((!isset($id_bom)) or (!isset($id_produk))) show_404();

        if ($this->m_bom->delete_bom($id_bom, $id_produk)) {
            $this->session->set_flashdata('flash', 'dihapus');
            redirect(site_url('bom/view_data'));
        }
    }

    //fungsi untuk menghapus data ketika input data detail
    public function delete_form_detail($no_bom)
    {
        if ($this->m_bom->deleteFormInputDetailBOM($no_bom)) {
            $this->session->set_flashdata('flash', 'dihapus');
            redirect(site_url('bom/input_form_detail'));
        }
    }
}
