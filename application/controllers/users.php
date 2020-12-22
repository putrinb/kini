<?php

class users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_auth');
        // if(!$this->session->userdata('is_logged')){
        //         redirect('auth');
        //     }
    }

    public function index()
    {
        $data=[
            'title' => 'Registration Data',
        ];
        $this->load->view('users/register',$data);
    }

    public function insert()
    {
        $this->form_validation->set_rules('nama_user', 'Nama Pengguna', 'required|alpha_numeric_spaces',
                array('required' => '%s harus diisi!',
                        'alpha_numeric_spaces' => '%s hanya boleh diisi dengan angka, huruf, atau spasi.')
                );
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email',
                array('required' => '%s harus diisi!')
        );		
        $this->form_validation->set_rules('password', 'Harga Satuan', 'required|min_length[4]|max_length[8]',
                array('required' => '%s harus diisi!',
                'min_length'    => 'Panjang karakter min. 4!',
                'max_length'    => 'Panjang karakter max. 8!',
                )
        );
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi password', 'required|matches[password]',
                array('required' => '%s harus diisi!',
                      'matches' =>  'Password tidak sesuai!',
                )
        );
        
        $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
        $data=['title' => 'Registration Data',
        ];
        
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('users/register',$data);
                
        }
        else
        {
            $this->m_auth->insert_data();
            $this->session->set_flashdata('flash','disimpan');
            redirect('auth');
        }
        
        
    }
        public function edit_data($kode_bb){
                if(!isset($kode_bb)) redirect('bahan_baku/view_data');

                $data['bahanbaku']= $this->m_bb->get_kode_bb($kode_bb);
                $data['title']          = 'Kini Cheese Tea | Bahan Baku';
                $data['heading']        = 'Edit Bahan Baku';
                $data['satuan']         = ['Kilogram (Kg)','Liter (L)','Gram (Gr)','Kaleng','Pieces (Pcs)','Pack','Balok'];

                $this->form_validation->set_rules('nama_bb', 'Nama Bahan Baku', 'required|alpha_numeric_spaces',
                        array('required' => '%s harus diisi!',
                                'alpha_numeric_spaces' => '%s hanya boleh diisi dengan angka, huruf, atau spasi.')
                        );
                $this->form_validation->set_rules('satuan', 'Satuan Bahan Baku', 'required',
                        array('required' => '%s harus diisi!')
                );		
                $this->form_validation->set_rules('harga_satuan', 'Harga Satuan', 'required',
                        array('required' => '%s harus diisi!',
                        )
                );
                $this->form_validation->set_rules('stok_awal', 'Stok Awal', 'required|numeric',
                        array('required' => '%s harus diisi!',
                        'numeric' =>  '%s hanya diisi oleh angka!',
                        )
                );              
                $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('templates/header',$data);
                        $this->load->view('templates/sidebar',$data);
                        $this->load->view('bahan_baku/edit_bb',$data);
                        $this->load->view('templates/footer');
                }
                else
                {
                        $this->m_bb->update_edit();
                        $this->session->set_flashdata('flash','diubah');
                        redirect('bahan_baku/view_data'); 
                }
        
        }



    public function view_data()
    {
        $data=array('bahan_baku' =>  $this->m_bb->getdata(),
        'title'=>'Kini Cheese Tea | Bahan Baku',
        'heading' => 'Bahan Baku'
        );
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('bahan_baku/view_data',$data);
        $this->load->view('templates/footer');
    }

    public function delete_data($kode_bb)
    {
            if (!isset($kode_bb)) show_404();

            if ($this->m_bb->delete($kode_bb)) {
                $this->session->set_flashdata('flash', 'dihapus');
                redirect(site_url('bahan_baku/view_data'));
            }
    }
}
?>