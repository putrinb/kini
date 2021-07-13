<?php
class m_bb extends CI_Model
{
    private $_table = "bahanbaku_utama";
	public $kode_bb;
	public $nama_bb;
	public $satuan;
    // public $harga_satuan;
    public $merk;
    public $stok_awal;  
    public $jumlah;      

    public function get_kode_bb($kode_bb)
    {
        return $this->db->get_where('bahanbaku_utama', array('kode_bb' => $kode_bb))->row_array();
    }
    public function insert_data(){
        $post = $this->input->post();
        $this->kode_bb = $this->getkodebb();
        $this->nama_bb = $post["nama_bb"];
        $this->satuan = $post["satuan"];
        $this->merk = $post["merk"];
        $this->stok_awal = $post["stok_awal"];
        $this->jumlah = $post["jml"];
        // $this->batas_min = $post["stok_min"];
        
        $sql = "INSERT INTO bahanbaku_utama(kode_bb,nama_bb,jumlah,satuan,stok_awal,merk,keterangan) ";
        $sql = $sql." VALUES(".$this->db->escape($this->kode_bb).",".$this->db->escape($this->nama_bb).",";
        $sql = $sql."".$this->db->escape($this->jumlah).",".$this->db->escape($this->satuan).",";
        $sql = $sql."".$this->db->escape($this->stok_awal).",".$this->db->escape($this->merk).", 'Bahan Baku Utama')";
        $query = $this->db->query($sql);
        return $this->db->affected_rows();
    }

    // buat kode_bb
    public function getkodebb()
	{
		$sql = "SELECT (substring(IFNULL(MAX(kode_bb),0),5)+0) as hsl FROM ".$this->_table;
		$query = $this->db->query($sql);
		$hasil = $query->result_array();
		foreach($hasil as $cacah):
		$jml_data = $cacah['hsl'];
		endforeach;
		$id = 'BBU-';
		$nomor = str_pad(($jml_data+1),3,"0",STR_PAD_LEFT); //ID-001
		$id = $id.$nomor;
		return $id;
    }
    
    public function getdata(){
        //$this->db->order_by('nama', 'ASC');
        $sql ="SELECT * FROM bahanbaku_utama";
        $query = $this->db->query($sql); 
        return $query->result_array();
    }

    public function getdata2(){
        if(isset($_SESSION['id_bom'])){
            $sql = "SELECT * FROM bahanbaku_utama
        WHERE kode_bb NOT IN 
        (SELECT kode_bb FROM detail_bom WHERE id_bom = ".$this->db->escape($_SESSION['id_bom']).")
        ORDER BY nama_bb ASC ";
        }else{
            //query tanpa where
            $sql = "SELECT * FROM bahanbaku_utama 
        ";
        }        
        
        $query = $this->db->query($sql);
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
        $this->merk = $post["merk"];
        $this->stok_awal = $post["stok_awal"];
        $this->jumlah = $post["jml"];
        // $this->batas_min = $post["stok_min"];
			
			$sql = "UPDATE ".$this->_table;
			$sql = $sql." SET nama_bb = ".$this->db->escape($this->nama_bb).", satuan = ".$this->db->escape($this->satuan);
            // $sql = $sql." , harga_satuan = ".$this->db->escape($this->harga_satuan);
            $sql = $sql." , stok_awal = ".$this->db->escape($this->stok_awal);
            $sql = $sql." , merk = ".$this->db->escape($this->merk);
            $sql = $sql." , jumlah = ".$this->db->escape($this->jumlah);
            // $sql = $sql." , batas_min = ".$this->db->escape($this->batas_min);
			$sql = $sql." WHERE kode_bb = ".$this->db->escape($post["kode_bb"]);
			$query = $this->db->query($sql);
			return $this->db->affected_rows();
        // return $this->db->get_where('bahanbaku_utama', array('kode_bb' => $kode_bb))->row_array();
    }

    public function delete($kode_bb)
    {
        return $this->db->delete('bahanbaku_utama', array("kode_bb" => $kode_bb));
    }
    
}
?>