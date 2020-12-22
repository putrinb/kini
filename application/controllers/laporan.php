<?php
class laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    //    session_start();
        // $this->load->model('penjualan_model');
        $this->load->model('m_laporan');
        $this->load->model('m_bb'); //digunakan untuk melihat id buah dan nama buah
        // $this->load->helper('format_bulan'); //format  dari 01 -> januari, dst

            // $this->load->helper('cek_login');
            // if(!cek_login()){
            //     redirect(site_url('welcome'));
            // }

            // $this->load->helper('cek_hak_akses');
            // if(!cek_hak_akses($this->uri->segment(1))){
            //     redirect(site_url('welcome/awal'));
            // }
    }
    //untuk form kartu stok
    public function input_form_ks()
    {
        $data=[
            'tahun' => $this->m_laporan->getTahun(),
            'bahan_baku' => $this->m_bb->getdata(),
            'title'   => 'Kini Cheese Tea | Laporan',
            'heading'  => 'Kartu Stok',
        ];

        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('laporan/form_input_ks', $data);
        $this->load->view('templates/footer', $data);
    }	
        
    //untuk memproses kartu stok
    public function proseskartustok(){
                
        $post = $this->input->post();
        $bulan = $this->input->post('bulan'); 
        $tahun = $this->input->post('tahun'); 
        $waktu = $tahun."-".str_pad($bulan,2,"0",STR_PAD_LEFT); //YYYY-mm
        $kode_bb = $this->input->post('bahan_baku');
        $databb = $this->m_bb->get_kode_bb($kode_bb); //mendapatkan data buah
        $data['stok'] = $this->m_laporan->getJumlahpersediaan($kode_bb,$waktu); //mendapatkan jumlah persediaan bln sebelumnya
        $data['data_pembelian_penjualan'] = $this->m_laporan->getKartustok($kode_bb,$waktu); //mendapatkan kartu stok
        $data['bulan'] = str_pad($bulan,2,"0",STR_PAD_LEFT);
        $data['tahun'] = $tahun;
        $data['bahan_baku'] = $databb;
        $this->load->view('templates/header',$data);
        $this->load->view('templates/header',$data);
        $this->load->view('laporan/view_kartu_stok', $data);
        $this->load->view('templates/footer', $data);
    }        
}


?>