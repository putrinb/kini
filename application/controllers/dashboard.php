<?php

class dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('m_bom');
        
    }
    public function index()
    {
        $data=[
            'title'     =>   'Kini Cheese Tea | Dashboard',
            'heading'   =>   'Dashboard',
            'bb'        => $this->m_bom->CountBB(),
            'produk'        => $this->m_bom->CountProduk(),
            'penerimaan'        => $this->m_bom->CountPenerimaan(),
            'bom'        => $this->m_bom->CountBOM(),
        ];
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('dashboard',$data);
        $this->load->view('templates/footer',$data);
        
    }
}

?>