<?php

class produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_produk');
        if(!$this->session->userdata('is_logged')){
                redirect('auth');
            }
    }

    // public function index()
    // {
    //     $data=[
    //         // 'bahan_baku' =>  $this->m_produk->getdata(),
    //         'title' =>  'Kini Cheese Tea | Produk',
    //         'heading'   =>  'Produk',
    //     ];
    //     $this->load->view('templates/header',$data);
    //     $this->load->view('templates/sidebar',$data);
    //     $this->load->view('produk/view_data',$data);
    //     $this->load->view('templates/footer');
    // }

    public function add()
    {
        $data=[
            'id_produk' => $this->m_produk->getIdProduk(),
            'title' =>  'Kini Cheese Tea | Produk',
            'heading'   =>  'Produk',
        ];
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('produk/input',$data);
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|alpha_numeric_spaces',
                array('required' => '%s harus diisi!',
                        'alpha_numeric_spaces' => '%s hanya boleh diisi dengan angka, huruf, atau spasi.')
                );
        
        $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
        $data=[
            'id_produk' => $this->m_produk->getIdProduk(),
            'title'=>'Kini Cheese Tea | Produk',
            'heading' => 'Tambah Data Produk'
        ];
        
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('templates/header',$data);
                $this->load->view('templates/sidebar',$data);
                $this->load->view('produk/input',$data);
                $this->load->view('templates/footer');
        }
        else
        {
                 $data['data_produk'] = array('id_produk'=> $this->m_produk->getIdProduk(),
                                'nama_produk'   =>  $this->input->post('nama_produk'), 
                                'gambar'        =>  $this->input->post('image'),
                          );
                 
                $this->m_produk->insert_data();   
                $this->session->set_flashdata('flash','ditambahkan');
                redirect('produk/view_data');
        }
        
        
    }
        public function edit_data($id_produk){
                if(!isset($id_produk)) redirect('produk/view_data');

                $data['produk']= $this->m_produk->getEdit($id_produk);
                $data['title']          = 'Kini Cheese Tea | Produk';
                $data['heading']        = 'Edit Produk';

                $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|alpha_numeric_spaces',
                        array('required' => '%s harus diisi!',
                                'alpha_numeric_spaces' => '%s hanya boleh diisi dengan angka, huruf, atau spasi.')
                );

                $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('templates/header',$data);
                        $this->load->view('templates/sidebar',$data);
                        $this->load->view('produk/edit_produk',$data);
                        $this->load->view('templates/footer');
                }
                else
                {
                        $this->m_produk->update_data($id_produk);
                        $this->session->set_flashdata('flash','diubah');
                        redirect('produk/view_data'); 
                }
        
        }

    public function view_data()
    {
        $data=array('data_produk' =>  $this->m_produk->getdata(),
        'title'=>'Kini Cheese Tea | Produk',
        'heading' => 'Produk'
        );
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('produk/view_data',$data);
        $this->load->view('templates/footer');
    }

    public function delete_data($id_produk)
    {
            if (!isset($id_produk)) show_404();

            if ($this->m_produk->delete($id_produk)) {
                $this->session->set_flashdata('flash', 'dihapus');
                redirect(site_url('produk/view_data'));
            }
    }
}
?>