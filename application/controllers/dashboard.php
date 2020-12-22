<?php

class dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('is_logged')){
                redirect('auth');
            }
    }
    public function index()
    {
        $data=[
            'title'     =>   'Kini Cheese Tea | Dashboard',
            'heading'   =>   'Dashboard',
        ];
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('dashboard',$data);
        $this->load->view('templates/footer',$data);
        
    }
}

?>