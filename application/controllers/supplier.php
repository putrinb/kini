<?php

class Supplier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_supplier');
        if(!$this->session->userdata('is_logged')){
                redirect('auth');
            }
    }
    public function index()
    {
        $data=[
            'supplier' =>  $this->m_supplier->getdata(),
            'title' =>  'Kini Cheese Tea | Supplier',
            'heading'   =>  'Supplier',
        ];
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('supplier/view_data',$data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $data=[
            'title' =>  'Kini Cheese Tea | Supplier',
            'heading'   =>  'Supplier',
        ];
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('supplier/form_supplier',$data);
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'required|alpha_numeric_spaces',
                array('required' => '%s harus diisi!',
                        'alpha_numeric_spaces' => '%s hanya boleh diisi dengan angka, huruf, atau spasi.')
                );
        $this->form_validation->set_rules('alamat', 'Alamat Supplier', 'required|max_length[50]',
                array('required' => '%s harus diisi!',
                'max_length[50]'    =>  'Jumlah karakter max. 50 karakter!')
        );		
        $this->form_validation->set_rules('no_telp', 'No. Telepon', 'required',
                array('required' => '%s harus diisi!',
                )
        );
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email',
                array('required' => '%s harus diisi!',
                      'valid_email' =>  'Isi %s dengan email yang valid!',
                )
        );
        
        $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
        $data=['title'=>'Supplier | Input Supplier',
                'heading' => 'Tambah Supplier'];
        
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('templates/header',$data);
                $this->load->view('templates/sidebar',$data);
                $this->load->view('supplier/form_supplier',$data);
                $this->load->view('templates/footer');
        }
        else
        {
                 $post = $this->input->post();
                 $data['kirim'] = array('id'=> $this->m_supplier->getdata(),
                                'nama_supplier'=>$post["nama_supplier"],
                                'alamat'=>$post["alamat"],  
                                'no_telp'=>$post["no_telp"],
                                'email'=>$post["email"]
                          );
                 
                $hasil = $this->m_supplier->insert_data();   
                if($hasil>0){
                        $this->session->set_flashdata('flash','ditambahkan');
                        redirect('supplier/view_data');
                }else{
                    $data['pesan_error'] = 'Input data tidak berhasil';
                    $this->load->view('templates/header');
                    $this->load->view('templates/sidebar',$data);
                    $this->load->view('supplier/form_supplier', $data);
                    $this->load->view('templates/footer');
                }
                
        }
        
    }
    public function edit_data($id_supplier){
        if(!isset($id_supplier)) redirect('supplier/view_data');
        $data_form_input = $this->m_supplier->getdata_edit($id_supplier);
        $this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'required|alpha_numeric_spaces',
                array('required' => '%s harus diisi!',
                        'alpha_numeric_spaces' => '%s hanya boleh diisi dengan angka, huruf, atau spasi.')
                );
        $this->form_validation->set_rules('alamat', 'Alamat Supplier', 'required|max_length[50]',
                array('required' => '%s harus diisi!',
                'max_length[50]'    =>  'Jumlah karakter max. 50 karakter!')
        );		
        $this->form_validation->set_rules('no_telp', 'No. Telepon', 'required',
                array('required' => '%s harus diisi!',
                )
        );
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email',
                array('required' => '%s harus diisi!',
                      'valid_email' =>  'Isi %s dengan email yang valid!',
                )
        );            
        $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
        if ($this->form_validation->run()) {
                $this->m_supplier->update_edit($id_supplier);
                $this->session->set_flashdata('flash','diubah');
                redirect('supplier/view_data'); 
        }
        $data=[
                'data_form_input' => $data_form_input,
                'title' => 'Kini Cheese Tea | Supplier',
                'heading'      => 'Edit Supplier',
        ];
        if (!$data["data_form_input"]) show_404();
        
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('supplier/edit_supplier', $data);
        $this->load->view('templates/footer', $data);
}

    public function update_supplier()
        {
            $data=array(
                'nama_supplier' =>      $this->input->post('nama_supplier'),
                'alamat'        =>      $this->input->post('alamat'),
                'no_telp'       =>      $this->input->post('no_telp'),
                'email'         =>      $this->input->post('email'),
            );

            $this->db->where('id_supplier',$this->input->post('id_supplier'));
            $this->db->update('supplier',$data); 
            redirect(site_url('supplier/view_data'));
        }

    public function view_data()
    {
        $data=array('supplier' =>  $this->m_supplier->getdata(),
        'title'=>'Kini Cheese Tea | Supplier',
        'heading' => 'Supplier'
        );
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('supplier/view_data',$data);
        $this->load->view('templates/footer');
    }

    public function delete_data($id_supplier)
    {
            if (!isset($id_supplier)) show_404();

            if ($this->m_supplier->delete($id_supplier)) {
                $this->session->set_flashdata('flash', 'dihapus');
                redirect(site_url('supplier/view_data'));
            }
    }
}
?>