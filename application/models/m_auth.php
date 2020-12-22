<?php
class m_auth extends CI_model
{
	private $_table = "users";

	public function get_user($username)
	{
		return $this->db->get_where('user',['username' => $username])->row_array();
		
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

    public function getdata_edit($kode_bb){
        $sql = "SELECT * ";
        $sql = $sql." FROM ".$this->_table." WHERE kode_bb = ".$this->db->escape($kode_bb);
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function update_edit()
    {
        $post = $this->input->post();
        $this->kode_bb = $this->getkodebb();
        $this->nama_bb= $post["nama_bb"];
        $this->satuan = $post["satuan"];
        $this->harga_satuan = str_replace(".","",$post["harga_satuan"]);
        $this->stok_awal = $post["stok_awal"];
			
			$sql = "UPDATE ".$this->_table;
			$sql = $sql." SET nama_bb = ".$this->db->escape($this->nama_bb).", satuan = ".$this->db->escape($this->satuan);
            $sql = $sql." , harga_satuan = ".$this->db->escape($this->harga_satuan);
            $sql = $sql." , stok_awal = ".$this->db->escape($this->stok_awal);
			$sql = $sql." WHERE kode_bb = ".$this->db->escape($post["kode_bb"]);
			$query = $this->db->query($sql);
			return $this->db->affected_rows();
        // return $this->db->get_where('bahan_baku', array('kode_bb' => $kode_bb))->row_array();
    }

    public function delete($kode_bb)
    {
        return $this->db->delete('bahan_baku', array("kode_bb" => $kode_bb));
    }
}