<?php

class Coa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_coa');
        if(!$this->session->userdata('is_logged')){
            redirect('auth');
        }
    }
    public function index()
    {
        $data=[
            'supplier' =>  $this->m_coa->getdata(),
            'title' =>  'Kini Cheese Tea | Chart of Account',
            'heading'   =>  'Chart of Account',
            'coa'       =>  $this->m_coa->getdata(),
        ];
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('coa/view_data',$data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $data=[
            'title'     =>  'Kini Cheese Tea | Chart of Account',
            'heading'   =>  'Chart of Account',
        ];
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('coa/form_coa',$data);
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $this->form_validation->set_rules('no_akun', 'Kode Akun', 'required|is_unique[akun.no_akun]',
                        array('required' => '%s harus diisi!',
                                'is_unique' => '%s sudah ada!')
                        );
        $this->form_validation->set_rules('nama_akun', 'Nama Akun', 'required|alpha_numeric_spaces',
                array('required' => '%s harus diisi!',
                        'alpha_numeric_spaces' => '%s hanya boleh diisi dengan angka, huruf, atau spasi.')
                );
        $this->form_validation->set_rules('header_akun', 'Header Akun', 'required|max_length[50]',
                array('required' => '%s harus diisi!',
                'max_length[50]'    =>  'Jumlah karakter max. 50 karakter!')
        );		
        
        $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
        $data=[
                'title'=>'Kini Cheese Tea | Chart of Account',
                'heading' => 'Tambah Chart of Account'
        ];
        
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('templates/header',$data);
                $this->load->view('templates/sidebar',$data);
                $this->load->view('coa/form_coa',$data);
                $this->load->view('templates/footer');
        }
        else
        {
                 $post = $this->input->post();
                 $data['kirim'] = array(
                                'no_akun' => $post["no_akun"],
                                'nama_akun'  => $post["nama_akun"],
                                'header_akun'=> $post["header_akun"],  
                          );
                 
                $hasil = $this->m_coa->insert_data();   
                if($hasil>0){
                    $this->session->set_flashdata('flash','ditambahkan');
                    redirect('coa/view_data');
                }else{
                    $data['pesan_error'] = 'Input data tidak berhasil';
                    $this->load->view('templates/header');
                    $this->load->view('templates/sidebar',$data);
                    $this->load->view('coa/form_coa', $data);
                    $this->load->view('templates/footer');
                }
                
        }
        
        
    }

    public function view_data()
    {
        $data=array(
                'coa' =>  $this->m_coa->getDataOrderByNo(),
                'title'=>'Kini Cheese Tea | Chart of Account',
                'heading' => 'Chart of Account'
        );
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('coa/view_data',$data);
        $this->load->view('templates/footer');
    }

    public function delete_data($no_akun)
    {
            if (!isset($no_akun)) show_404();

            if ($this->m_coa->delete($no_akun)) {
                $this->session->set_flashdata('flash','dihapus');
                    redirect(site_url('coa/view_data'));
            }
    }
}
?>