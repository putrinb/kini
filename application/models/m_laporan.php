<?php

class m_laporan extends CI_Model
{
	private $_table = "penerimaan";
	function get_penerimaan()
	{
		$this->db->select("penerimaan.id_penerimaan, concat(day(penerimaan.tanggal),' ',monthname(penerimaan.tanggal),' ',year(penerimaan.tanggal)) as Tanggal, sum(detail_penerimaan.jumlah*detail_penerimaan.harga_satuan) as total");
		$this->db->from('penerimaan');
		$this->db->join('detail_penerimaan','detail_penerimaan.id_penerimaan=penerimaan.id_penerimaan');
		$this->db->group_by('month(penerimaan.tanggal)');
		$this->db->order_by('penerimaan.tanggal');
		return $this->db->get()->result();
	}

	function get_lap_penerimaan($tanggal)
	{
		$this->db->select("penerimaan.id_penerimaan, concat(day(penerimaan.tanggal),' ',monthname(penerimaan.tanggal),' ',year(penerimaan.tanggal)) as Tanggal, sum(detail_penerimaan.jumlah*detail_penerimaan.harga_satuan) as total");
		$this->db->from('penerimaan');
		$this->db->join('detail_penerimaan','detail_penerimaan.id_penerimaan=penerimaan.id_penerimaan');
		$this->db->order_by('penerimaan.tanggal');
		return $this->db->get_where('penerimaan', array('month(tanggal)' => $tanggal))->result_array();

	}

	function get_penerimaan_pertahun()
	{
		$this->db->select("penerimaan.id_penerimaan, penerimaan.tanggal, sum(detail_penerimaan.jumlah*detail_penerimaan.harga_satuan) as total");
		$this->db->from('penerimaan');
		$this->db->join('detail_penerimaan','detail_penerimaan.id_penerimaan=penerimaan.id_penerimaan');
		$this->db->group_by('year(penerimaan.tanggal)');
		$this->db->order_by('penerimaan.tanggal');
		return $this->db->get()->result();
	}

	function get_penerimaan_perbulan()
	{
		$this->db->select("penerimaan.id_penerimaan, concat(monthname(penerimaan.tanggal),' ',year(penerimaan.tanggal)) as Tanggal, sum(detail_penerimaan.jumlah*detail_penerimaan.harga_satuan) as total");
		$this->db->from('penerimaan');
		$this->db->join('detail_penerimaan','detail_penerimaan.id_penerimaan=penerimaan.id_penerimaan');
		$this->db->group_by('month(penerimaan.tanggal)');
		$this->db->order_by('penerimaan.tanggal');
		return $this->db->get()->result();
	}

	public function get_supplier(){
		$sql = "SELECT a.*,b.nama as NamaSupplier FROM ".$this->_table." a ";
		$sql = $sql." JOIN supplier b ON (a.id_supplier=b.id_supplier) ";
		$query = $this->db->query($sql);
		
		return $query->result_array();
	  }

  	public function view_by_date($date){
		$this->db->select("*");
		$this->db->from('penerimaan');
		$this->db->join('detail_penerimaan','detail_penerimaan.id_penerimaan=penerimaan.id_penerimaan');
		// $this->db->join('supplier','detail_penerimaan.id_supplier=supplier.id_supplier');
		$this->db->join('bahan_baku','detail_penerimaan.kode_bb=bahan_baku.kode_bb');
		$this->db->where('DATE(tanggal)', $date); // Tambahkan where tanggal nya
		$this->db->order_by('DATE(tanggal)');
        
    return $this->db->get()->result();// Tampilkan data penerimaan sesuai tanggal yang diinput oleh user pada filter
  	}
    
  	public function view_by_month($month, $year){
		$this->db->select("*");
		$this->db->from('penerimaan');
		$this->db->join('detail_penerimaan','detail_penerimaan.id_penerimaan=penerimaan.id_penerimaan');
		// $this->db->join('supplier','detail_penerimaan.id_supplier=supplier.id_supplier');
		$this->db->join('bahan_baku','detail_penerimaan.kode_bb=bahan_baku.kode_bb');
        $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
		$this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
		// $this->db->group_by('date(tanggal)');
        
    return $this->db->get()->result(); // Tampilkan data penerimaan sesuai bulan dan tahun yang diinput oleh user pada filter
  	}
    
  	public function view_by_year($year){
		$this->db->select("*");
		$this->db->from('penerimaan');
		$this->db->join('detail_penerimaan','detail_penerimaan.id_penerimaan=penerimaan.id_penerimaan');
		// $this->db->join('supplier','detail_penerimaan.id_supplier=supplier.id_supplier');
		$this->db->join('bahan_baku','detail_penerimaan.kode_bb=bahan_baku.kode_bb');
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        
    return $this->db->get()->result(); // Tampilkan data penerimaan sesuai tahun yang diinput oleh user pada filter
  	}
    
  	public function view_all(){
		$this->db->select("*");
		$this->db->from('penerimaan');
		$this->db->join('detail_penerimaan','detail_penerimaan.id_penerimaan=penerimaan.id_penerimaan');
		// $this->db->join('supplier','detail_penerimaan.id_supplier=supplier.id_supplier');
		$this->db->join('bahan_baku','detail_penerimaan.kode_bb=bahan_baku.kode_bb');
    return $this->db->get()->result(); // Tampilkan semua data penerimaan
  	}
    
    public function option_tahun(){
        $this->db->select('YEAR(tanggal) AS tahun'); // Ambil Tahun dari field tgl
		$this->db->from('penerimaan'); // select ke tabel penerimaan
		$this->db->join('detail_penerimaan','detail_penerimaan.id_penerimaan=penerimaan.id_penerimaan');
		// $this->db->join('supplier','detail_penerimaan.id_supplier=supplier.id_supplier');
		$this->db->join('bahan_baku','detail_penerimaan.kode_bb=bahan_baku.kode_bb');
		$this->db->group_by('YEAR(tanggal)', 'detail_penerimaan.id_penerimaan'); // Group berdasarkan tahun pada field tgl
        $this->db->order_by('YEAR(tanggal)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
	}
	
	public function view_by_date2($date){
		$this->db->select("*");
		$this->db->from('penjualan');
		$this->db->join('detail_jual','detail_jual.id_penjualan=penjualan.id_penjualan');
		$this->db->join('produk','detail_jual.id_produk=produk.id_produk');
		$this->db->where('DATE(tanggal)', $date); // Tambahkan where tanggal nya
		$this->db->order_by('DATE(tanggal)');
        
    return $this->db->get()->result();// Tampilkan data penjualan sesuai tanggal yang diinput oleh user pada filter
  	}
    
  	public function view_by_month2($month, $year){
		$this->db->select("*");
		$this->db->from('penjualan');
		$this->db->join('detail_jual','detail_jual.id_penjualan=penjualan.id_penjualan');
		$this->db->join('produk','detail_jual.id_produk=produk.id_produk');
        $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
		$this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
		// $this->db->group_by('date(tanggal)');
        
    return $this->db->get()->result(); // Tampilkan data penerimaan sesuai bulan dan tahun yang diinput oleh user pada filter
  	}
    
  	public function view_by_year2($year){
		$this->db->select("*");
		$this->db->from('penjualan');
		$this->db->join('detail_jual','detail_jual.id_penjualan=penjualan.id_penjualan');
		$this->db->join('produk','detail_jual.id_produk=produk.id_produk');
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        
    return $this->db->get()->result(); // Tampilkan data penerimaan sesuai tahun yang diinput oleh user pada filter
  	}
    
  	public function view_all2(){
		$this->db->select("*");
		$this->db->from('penjualan');
		$this->db->join('detail_jual','detail_jual.id_penjualan=penjualan.id_penjualan');
		$this->db->join('produk','detail_jual.id_produk=produk.id_produk');
    return $this->db->get()->result(); // Tampilkan semua data penerimaan
  	}
    
    public function option_tahun2(){
        $this->db->select('YEAR(tanggal) AS tahun'); // Ambil Tahun dari field tgl
		$this->db->from('penjualan');
		$this->db->join('detail_jual','detail_jual.id_penjualan=penjualan.id_penjualan');
		$this->db->join('produk','detail_jual.id_produk=produk.id_produk');
		$this->db->group_by('YEAR(tanggal)', 'detail_penerimaan.id_penerimaan'); // Group berdasarkan tahun pada field tgl
        $this->db->order_by('YEAR(tanggal)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }

}
?>