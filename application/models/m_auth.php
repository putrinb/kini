<?php
class m_auth extends CI_model
{
	private $_table = "users";

	public function get_user($username)
	{
		return $this->db->get_where('users',['username' => $username])->row_array();
		
	}

	public function getUserId($id_user)
	{
		return $this->db->get_where('users', array('id_user' => $id_user))->row_array();
	}
    
	public function insert_data()
	{
		$data = array(
			'id_user'=> $this->m_auth->IdUser(),
			'nama_user' => $this->input->post('nama_user'),
        	'email' 	=> $this->input->post('email'),
        	'password' 	=> $this->input->post('password'),
		);
		
		$this->db->insert('users', $data);
    }

    // buat id_user
    public function IdUser()
	{
		$sql = "SELECT (substring(IFNULL(MAX(id_user),0),5)+0) as hsl FROM ".$this->_table;
		$query = $this->db->query($sql);
		$hasil = $query->result_array();
		foreach($hasil as $cacah):
		$jml_data = $cacah['hsl'];
		endforeach;
		$id = 'ID-';
		$nomor = str_pad(($jml_data+1),3,"0",STR_PAD_LEFT); //ID-001
		$id = $id.$nomor;
		return $id;
    }
    
    public function getdata(){
        //$this->db->order_by('nama', 'ASC');
        $query = $this->db->get($this->_table); 
        return $query->result_array();
    }

}