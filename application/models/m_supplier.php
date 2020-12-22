<?php
class m_supplier extends CI_Model
{
    private $_table = "supplier";
	public $id_supplier;
	public $nama_supplier;
	public $alamat;
	public $no_telp;
    public $email;        

    public function get_id_supplier()
    {
        return $this->db->get_where('supplier', array('status' => '1'))->row_array();
    }
    public function insert_data(){
        $post = $this->input->post();
        $this->id_supplier = $this->getId();
        $this->nama_supplier= $post["nama_supplier"];
        $this->alamat = $post["alamat"];
        $this->no_telp = $post["no_telp"];
        $this->email = $post["email"];
        
        $sql = "INSERT INTO supplier(id_supplier,nama_supplier,alamat,no_telp,email) ";
        $sql = $sql." VALUES(".$this->db->escape($this->id_supplier).",".$this->db->escape($this->nama_supplier).",".$this->db->escape($this->alamat);
        $sql = $sql.",".$this->db->escape($this->no_telp).",".$this->db->escape($this->email).")";
        $query = $this->db->query($sql);
        return $this->db->affected_rows();
    }

    // buat id_supplier
    public function getId()
	{
		$sql = "SELECT (substring(IFNULL(MAX(id_supplier),0),4)+0) as hsl FROM ".$this->_table;
		$query = $this->db->query($sql);
		$hasil = $query->result_array();
		foreach($hasil as $cacah):
		$jml_data = $cacah['hsl'];
		endforeach;
		$id = 'S-';
		$nomor = str_pad(($jml_data+1),3,"0",STR_PAD_LEFT); //ID-001
		$id = $id.$nomor;
		return $id;
    }
    
    public function getdata(){
        //$this->db->order_by('nama', 'ASC');
        $query = $this->db->get($this->_table); 
        return $query->result_array();
    }

    public function getdata_edit($id_supplier){
        $sql = "SELECT * ";
        $sql = $sql." FROM ".$this->_table." WHERE id_supplier = ".$this->db->escape($id_supplier);
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function update_edit($id_supplier)
    {
        $post = $this->input->post();
        $this->id_supplier = $this->getId();
        $this->nama_supplier= $post["nama_supplier"];
        $this->alamat = $post["alamat"];
        $this->no_telp = str_replace(".","",$post["no_telp"]);
        $this->email = $post["email"];
			
			$sql = "UPDATE ".$this->_table;
			$sql = $sql." SET nama_supplier = ".$this->db->escape($this->nama_supplier).", alamat = ".$this->db->escape($this->alamat);
            $sql = $sql." , no_telp = ".$this->db->escape($this->no_telp);
            $sql = $sql." , email = ".$this->db->escape($this->email);
			$sql = $sql." WHERE id_supplier = ".$this->db->escape($post["id_supplier"]);
			$query = $this->db->query($sql);
			return $this->db->affected_rows();
    }

    public function delete($id_supplier)
    {
        return $this->db->delete('supplier', array("id_supplier" => $id_supplier));
    }
}
?>