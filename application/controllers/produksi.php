<?php
date_default_timezone_set('Asia/Jakarta');

class produksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_produksi');
        $this->load->model('m_bom');

        check_not_login();
    }

    public function view()
    {
        $data = [
            'heading' => 'Produksi',
            'title' => 'Kini Cheese Tea | Produksi',
            'sales' =>  $this->m_produksi->get_order()
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('produksi/penjualan', $data);
        $this->load->view('templates/footer');
    }

    public function detail_order($tgl2)
    {
        $data = [
            'heading' => 'Produksi',
            'title' => 'Kini Cheese Tea | Produksi',
            'order' =>  $this->m_produksi->get_detail_order($tgl2),
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('produksi/detail_order', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data = [
            'no_produksi' => $this->m_produksi->getIdProduksi(),
            'title' =>  'Kini Cheese Tea | Produksi',
            'heading'   =>  'Produksi',
        ];
        $waktu2 = $this->input->post('waktu');

        $_SESSION['no_produksi'] = $data['no_produksi'];
        $_SESSION['tgl2'] = $this->input->post('tgl'); // tgl transaksi
        $_SESSION['id_minum'] = $this->input->post('id_minum');
        $_SESSION['waktu'] = $waktu2; // tgl catat
        $_SESSION['nilai_bbb'] = $this->input->post('nilai_bbb');

        $data['order'] =  $this->m_produksi->get_detail_order($_SESSION['tgl2']);
        $data['bom'] = $this->m_produksi->getListBOM($_SESSION['tgl2']);
        $data['hargaBOM'] = $this->m_produksi->getHargaBOM($_SESSION['id_minum']);
        $data['hargaTopping'] = $this->m_produksi->getHargaTopping($_SESSION['tgl2']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('produksi/view_bom_order', $data);
        $this->load->view('templates/footer', $data);
    }

    public function bop()
    {
        $data = [
            'no_produksi' => $this->m_produksi->getIdProduksi(),
            'title' =>  'Kini Cheese Tea | Produksi',
            'heading'   =>  'Produksi',
            'Op'    => $this->m_produksi->getOp(),
        ];

        $_SESSION['nilai_bbb'] = $this->input->post('nilai_bbb');
        $_SESSION['waktu'] = $this->input->post('waktu');
        $data['order'] =  $this->m_produksi->get_detail_order($_SESSION['tgl2']);
        $data['bom'] = $this->m_produksi->getListBOM($_SESSION['tgl2']);
        $data['hargaBOM'] = $this->m_produksi->getHargaBOM($_SESSION['id_minum']);
        $data['data_bop'] = $this->m_produksi->getDataBOP($_SESSION['no_produksi']);

        $this->form_validation->set_rules(
            'tarif',
            'tarif dasar listrik',
            'required',
            array('required' => 'Anda harus memasukkan %s.')
        );

        $this->form_validation->set_rules(
            'type',
            'jenis penggunaan',
            'required',
            array('required' => 'Anda harus memasukkan %s.')
        );

        $this->form_validation->set_rules(
            'lama',
            'lama penggunaan',
            'required',
            array('required' => 'Anda harus memasukkan %s.')
        );

        $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'no_produksi' => $this->m_produksi->getIdProduksi(),
                'title' =>  'Kini Cheese Tea | Produksi',
                'heading'   =>  'Produksi',
                'Op'    => $this->m_produksi->getOp(),
            ];

            // $_SESSION['nilai_bbb'] = $this->input->post('nilai_bbb');
            // $_SESSION['waktu'] = $this->input->post('waktu');
            $data['order'] =  $this->m_produksi->get_detail_order($_SESSION['tgl2']);
            $data['bom'] = $this->m_produksi->getListBOM($_SESSION['tgl2']);
            $data['hargaBOM'] = $this->m_produksi->getHargaBOM($_SESSION['id_minum']);
            $data['data_bop'] = $this->m_produksi->getDataBOP($_SESSION['no_produksi']);

            // echo $_SESSION['nilai_bbb'];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('produksi/input_bop', $data);
            $this->load->view('produksi/view_detail_bop', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->m_produksi->input_bop();

            $data = [
                'no_produksi' => $this->m_produksi->getIdProduksi(),
                'title' =>  'Kini Cheese Tea | Produksi',
                'heading'   =>  'Produksi',
                'Op'    => $this->m_produksi->getOp(),
            ];
            // $waktu = $this->input->post('waktu');
            // $waktu2 = date("d-m-Y H:i:s", strtotime($waktu));
            // $_SESSION['nilai_bbb'] = $this->input->post('nilai_bbb');
            // $_SESSION['waktu'] = $this->input->post('waktu');
            $data['order'] =  $this->m_produksi->get_detail_order($_SESSION['tgl2']);
            $data['bom'] = $this->m_produksi->getListBOM($_SESSION['tgl2']);
            $data['hargaBOM'] = $this->m_produksi->getHargaBOM($_SESSION['id_minum']);
            $data['data_bop'] = $this->m_produksi->getDataBOP($_SESSION['no_produksi']);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('produksi/input_bop', $data);
            $this->load->view('produksi/view_detail_bop', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    public function input_bop2()
    {
        $data = [
            'no_produksi' => $this->m_produksi->getIdProduksi(),
            'title' =>  'Kini Cheese Tea | Produksi',
            'heading'   =>  'Produksi',
            'Op'    => $this->m_produksi->getOp(),
        ];
        // $_SESSION['nilai_bbb'] = $this->input->post('nilai_bbb');
        //     $_SESSION['waktu'] = $this->input->post('waktu');
        //     $data['order'] =  $this->m_produksi->get_detail_order($_SESSION['tgl2']);
        //     $data['bom'] = $this->m_produksi->getListBOM($_SESSION['tgl2']);
        //     $data['hargaBOM'] = $this->m_produksi->getHargaBOM($_SESSION['id_minum']);
        $data['data_bop'] = $this->m_produksi->getDataBOP($_SESSION['no_produksi']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('produksi/input_bop', $data);
        $this->load->view('produksi/view_detail_bop', $data);
        $this->load->view('templates/footer', $data);
    }

    public function delete_bop($id_bop)
    {
        if ($this->m_produksi->deleteListBOP($id_bop)) {
            $this->session->set_flashdata('flash', 'dihapus');
            redirect(site_url('produksi/input_bop2'));
        }
    }

    public function selesai()
    {
        $this->m_produksi->inputnilaiBOP($_SESSION['no_produksi']);
        unset($_SESSION['no_produksi']);
        unset($_SESSION['waktu']);
        unset($_SESSION['tgl2']);
        unset($_SESSION['id_minum']);
        unset($_SESSION['waktu']);
        unset($_SESSION['nilai_bbb']);
        $this->session->set_flashdata('flash', 'tersimpan');
        redirect('produksi/view');
    }

    public function batal()
    {
        //unset sesi yang digunakan untuk transaksi penerimaan
        unset($_SESSION['no_nota']);
        unset($_SESSION['no_produksi']);
        unset($_SESSION['tanggal']);
        $this->session->set_flashdata('flash', 'dibatalkan');
        redirect('produksi/view');
    }

    public function daftar_hpp()
    {
        $data = [
            'title' =>  'Kini Cheese Tea | Produksi',
            'heading'   =>  'Produksi',
            'data_bom' => $this->m_produksi->getData(),
        ];
        // $waktu2 = $this->input->post('waktu');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('produksi/view_hpp', $data);
        $this->load->view('templates/footer', $data);
    }
    
    public function view_data_detail($id_bom, $id_produk)
    {
        $data = [

            'title' =>  'Kini Cheese Tea | Produksi',
            'heading'   =>  'Produksi',
            'data_bom' => $this->m_bom->getDataDetail($id_bom, $id_produk),
            'harga_perBOM' => $this->m_produksi->getHargaBOM($id_produk),
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('produksi/view_detail_hpp', $data);
        $this->load->view('templates/footer');
    }
}
