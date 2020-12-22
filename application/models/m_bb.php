<?php
class m_bb extends CI_Model
{
    private $_table = "bahan_baku";
	public $kode_bb;
	public $nama_bb;
	public $satuan;
    // public $harga_satuan;
    public $merk;
    public $stok_awal;        

    public function get_kode_bb($kode_bb)
    {
        return $this->db->get_where('bahan_baku', array('kode_bb' => $kode_bb))->row_array();
    }
    public function insert_data(){
        $post = $this->input->post();
        $this->kode_bb = $this->getkodebb();
        $this->nama_bb= $post["nama_bb"];
        $this->satuan = $post["satuan"];
        // $this->harga_satuan = str_replace(".","",$post["harga_satuan"]);
        $this->merk = $post["merk"];
        $this->stok_awal = $post["stok_awal"];
        
        $sql = "INSERT INTO bahan_baku(kode_bb,nama_bb,satuan,stok_awal,merk) ";
        $sql = $sql." VALUES(".$this->db->escape($this->kode_bb).",".$this->db->escape($this->nama_bb).",".$this->db->escape($this->satuan);
        $sql = $sql.",".$this->db->escape($this->stok_awal).",".$this->db->escape($this->merk).")";
        $query = $this->db->query($sql);
        return $this->db->affected_rows();
    }

    // buat kode_bb
    public function getkodebb()
	{
		$sql = "SELECT (substring(IFNULL(MAX(kode_bb),0),4)+0) as hsl FROM ".$this->_table;
		$query = $this->db->query($sql);
		$hasil = $query->result_array();
		foreach($hasil as $cacah):
		$jml_data = $cacah['hsl'];
		endforeach;
		$id = 'BB-';
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
        // $this->harga_satuan = str_replace(".","",$post["harga_satuan"]);
        $this->merk = $post["merk"];
        $this->stok_awal = $post["stok_awal"];
			
			$sql = "UPDATE ".$this->_table;
			$sql = $sql." SET nama_bb = ".$this->db->escape($this->nama_bb).", satuan = ".$this->db->escape($this->satuan);
            // $sql = $sql." , harga_satuan = ".$this->db->escape($this->harga_satuan);
            $sql = $sql." , stok_awal = ".$this->db->escape($this->stok_awal);
            $sql = $sql." , merk = ".$this->db->escape($this->merk);
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
?>