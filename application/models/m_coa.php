<?php
class m_coa extends CI_Model
{
    private $_table = "akun";
    public $no_akun;
    public $nama_akun;
	public $header_akun;
	
    public function get_no_akun()
    {
        return $this->db->get_where('akun', array('status' => '1'))->row_array();
    }
    public function insert_data()
    {
        $post = $this->input->post();
        $this->no_akun = $post["no_akun"];
        $this->nama_akun= $post["nama_akun"];
        $this->header_akun = $post["header_akun"];
        
        $sql = "INSERT INTO akun(no_akun,nama_akun,header_akun) ";
        $sql = $sql." VALUES(".$this->db->escape($this->no_akun).",".$this->db->escape($this->nama_akun).",".$this->db->escape($this->header_akun).")";
        $query = $this->db->query($sql);
        return $this->db->affected_rows();
    }

    // buat no_akun
    // public function getkodebb()
	// {
	// 	$sql = "SELECT (substring(IFNULL(MAX(no_akun),0),4)+0) as hsl FROM ".$this->_table;
	// 	$query = $this->db->query($sql);
	// 	$hasil = $query->result_array();
	// 	foreach($hasil as $cacah):
	// 	$jml_data = $cacah['hsl'];
	// 	endforeach;
	// 	$id = 'S-';
	// 	$nomor = str_pad(($jml_data+1),3,"0",STR_PAD_LEFT); //ID-001
	// 	$id = $id.$nomor;
	// 	return $id;
    // }
    
    public function getdata(){
        //$this->db->order_by('nama', 'ASC');
        $query = $this->db->get($this->_table); 
        return $query->result_array();
    }

    public function getDataOrderByNo(){
        $this->db->order_by('no_akun', 'ASC');
        $query = $this->db->get($this->_table); 
        return $query->result_array();
    }

    // public function getdata_edit($no_akun){
    //     $sql = "SELECT * ";
    //     $sql = $sql." FROM ".$this->_table." WHERE no_akun = ".$this->db->escape($no_akun);
    //     $query = $this->db->query($sql);
    //     return $query->result_array();
    // }

    public function update_edit($no_akun)
    {
        return $this->db->get_where('akun', array('no_akun' => $no_akun))->row_array();
    }

    public function delete($no_akun)
    {
        return $this->db->delete('akun', array("no_akun" => $no_akun));
    }
}
?>