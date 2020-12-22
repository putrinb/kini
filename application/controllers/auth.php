<?php

class auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_auth');
		
	}

	function index()
	{
		$rules=[
			[
				'field'		=> 'username',
				'label'		=>	'Username',
				'rules'		=>	'required',
				'errors'	=>	[
					'required'		=>	'%s is required'
				]
			],

			[
				'field'		=> 'password',
				'label'		=>	'Password',
				'rules'		=>	'required',
				'errors'	=>	[
					'required'		=>	'%s is required'
				]
			],
		];
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == FALSE){
			$data=[
				'title'		=> 'Kini Cheese Tea | Login'
			];
			$this->load->view('templates/login',$data);
		}else{

			$this->_login();
		}
		
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user 		= $this->m_auth->get_user($username);

		//var_dump($user);die;
		if ($user)
		{
			if($user['user_status'] == 1) // active
			{
				if($user['password'] == $password)
				{
					// password valid
					// set user privileges
					if($user['user_privileges'] == 1){
						$role = 'Admin';

					}elseif($user['user_privileges'] == 2){
						$role = 'Pegawai';
					}elseif($user['user_privileges'] ==3){
						$role = 'Pemilik';
					}
					$data=[
						'name'			=>	$user['name'],
						'role'			=>	$user['user_privileges'],
						'role_label'	=>	$role,
						'is_logged'		=>	1
					];
					// save the user data into the session
					$this->session->set_userdata($data);

					// session has been saved
					$this->session->set_flashdata('sukses', 'Login Berhasil!');
										
					redirect('dashboard');

				}else{
					//password incorrect
					
					$this->session->set_flashdata('error', 'Password Anda salah!');
					redirect('auth');
				}
			}else{
				// user status invalid
				$this->session->set_flashdata('error', 'Akun anda diblokir');
				redirect('auth');
			}
		}else{
			// user not found
			$this->session->set_flashdata('error','User Tidak Ditemukan');
			redirect('auth');
			}
	}

	function logout()
	{
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('role_label');
		$this->session->unset_userdata('is_logged');
		$this->session->set_flashdata('sukses','Logout Berhasil!');
			redirect('auth');
	}

}
?>