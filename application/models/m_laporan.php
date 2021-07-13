<?php

class m_laporan extends CI_Model
{
	private $_table = "penerimaan";

	//data tahun
	public function getTahun(){
		$sql = "
					SELECT tahun FROM
					(
					SELECT year(tgl_pembelian) as tahun 
					FROM pembelian
					UNION
					SELECT year(tanggal) as tahun 
					FROM pemakaian
					) x
					ORDER BY 1 ASC
				";
				
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getBulan(){
		$sql = "
					SELECT bulan FROM
					(
					SELECT month(tgl_catat) as bulan 
					FROM biaya_produksi
					UNION
					SELECT month(tgl_jual) as bulan 
					FROM nota_penjualan
					) x
					ORDER BY 1 ASC
				";
				
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getBahanBaku(){
		$sql = "
					SELECT kode, bb FROM
					(
					SELECT kode_bb as kode, nama_bb as bb
					FROM bahanbaku_utama
					UNION
					SELECT kode_bb as kode, nama_bb as bb
					FROM bahan_baku
					) x
					ORDER BY 1 ASC			
				";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//mendapatkan stok persediaan pada akhir periode
	public function getStok($kode_bb,$waktu){
			
		//cari jumlah pembelian s/d bulan - 1 sebelumnya
		$sql = "SELECT * 
				FROM pembelian_detail 
				JOIN pembelian ON (pembelian_detail.id_pembelian = pembelian.id_pembelian)
				WHERE pembelian_detail.kode_bhn_baku_pembelian = ".$this->db->escape($kode_bb)."
				AND DATE_FORMAT(pembelian.tgl_pembelian,'%Y-%m') < ".$this->db->escape($waktu)."
				";
		$query = $this->db->query($sql);
		$hasil = $query->result_array();
		$jml_beli = 0;
		foreach($hasil as $cacah):
			$jml_beli = $jml_beli + $cacah['qty_pembelian'];
		endforeach;
		
		//cari jumlah penjualan s/d bulan -1 sebelumnya
		$sql = "SELECT * 
				FROM detail_bom a
				JOIN bom b ON (a.id_bom = b.id_bom)
				WHERE a.id_bom = ".$this->db->escape($id_bom)."
				AND DATE_FORMAT(b.,'%Y-%m') < ".$this->db->escape($waktu)."
				";
		
		$query = $this->db->query($sql);
		$hasil = $query->result_array();
		// $jml_penjualan = 0;
		// foreach($hasil as $cacah):
		// 	$jml_penjualan = $jml_penjualan + $cacah['jml_buah'];
		// endforeach;
		
		//hitung selisih pembelian dengan penjualan
		$selisih = $jml_beli;
		return $selisih;
	}

	public function getHarga($kode_bb,$waktu){
			
		//cari jumlah pembelian s/d bulan - 1 sebelumnya
		$sql = "SELECT * 
				FROM pembelian_detail 
				JOIN pembelian ON (pembelian_detail.id_pembelian = pembelian.id_pembelian)
				WHERE pembelian_detail.kode_bhn_baku_pembelian = ".$this->db->escape($kode_bb)."
				AND DATE_FORMAT(pembelian.tgl_pembelian,'%Y-%m') < ".$this->db->escape($waktu)."
				";
		$query = $this->db->query($sql);
		$hasil = $query->result_array();
		$harga_beli = 0;
		foreach($hasil as $cacah):
			$harga_beli = $cacah['harga_bhn_baku_pembelian'];
		endforeach;
		
		//cari jumlah penjualan s/d bulan -1 sebelumnya
		// $sql = "SELECT * 
		// 		FROM detail_penjualan a
		// 		JOIN penjualan b ON (a.id_penjualan = b.id_penjualan)
		// 		WHERE a.id_buah = ".$this->db->escape($id_buah)."
		// 		AND DATE_FORMAT(b.waktu,'%Y-%m') < ".$this->db->escape($waktu)."
		// 		";
		
		$query = $this->db->query($sql);
		$hasil = $query->result_array();
		// $jml_penjualan = 0;
		// foreach($hasil as $cacah):
		// 	$jml_penjualan = $jml_penjualan + $cacah['jml_buah'];
		// endforeach;
		
		//hitung selisih pembelian dengan penjualan
		$nilai = $harga_beli - 0;
		return $nilai;
		
	}

	public function getKartuStok($kode_bb,$waktu){
		$sql = "
					SELECT waktu,id,harga,ifnull(total_pembelian,0) as total_pembelian
					FROM 
					(
						SELECT distinct(date_format(pembelian.tgl_pembelian,'%d-%m-%Y')) as waktu, SUM(pembelian_detail.qty_pembelian) as total_pembelian,pembelian_detail.id_pembelian as id, harga_bhn_baku_pembelian as harga
						FROM pembelian_detail
						JOIN pembelian ON (pembelian_detail.id_pembelian = pembelian.id_pembelian)
						WHERE pembelian_detail.kode_bhn_baku_pembelian = ".$this->db->escape($kode_bb)."
						AND date_format(pembelian.tgl_pembelian,'%Y-%m') = ".$this->db->escape($waktu)."
						GROUP BY pembelian_detail.id_pembelian
					) x
					group by id 
					order by 1 asc

				";
		//echo $sql."<br>";
		// LEFT OUTER JOIN  	
		// 				(SELECT DATE_FORMAT(pembelian.tgl_pembelian,'%d-%m-%Y') as wkt,
		// 						SUM(pembelian_detail.qty_pembelian) as total_pembelian, pembelian_detail.id_pembelian as id, harga_bhn_baku_pembelian as harga
		// 				 FROM pembelian_detail
		// 				 JOIN pembelian ON (pembelian_detail.id_pembelian = pembelian.id_pembelian)
		// 				 WHERE pembelian_detail.kode_bhn_baku_pembelian = ".$this->db->escape($kode_bb)."
		// 				 AND date_format(pembelian.tgl_pembelian,'%Y-%m') = ".$this->db->escape($waktu)."
		// 				 GROUP BY DATE_FORMAT(pembelian.tgl_pembelian,'%d-%m-%Y')
		// 				 ) y
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_hpp($waktu)
	{
		$sql = "SELECT * FROM biaya_produksi";
		$sql = $sql. " WHERE DATE_FORMAT(tgl_catat,'%Y-%m') = '".$waktu."'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

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

  	public function view_by_date($date){
		$this->db->select("*");
		$this->db->from('penerimaan');
		$this->db->join('detail_penerimaan','detail_penerimaan.id_penerimaan=penerimaan.id_penerimaan');
		// $this->db->join('supplier','detail_penerimaan.id_supplier=supplier.id_supplier');
		$this->db->join('bahanbaku_utama','detail_penerimaan.kode_bb=bahanbaku_utama.kode_bb');
		$this->db->where('DATE(tanggal)', $date); // Tambahkan where tanggal nya
		$this->db->order_by('DATE(tanggal)');
        
    return $this->db->get()->result();// Tampilkan data penerimaan sesuai tanggal yang diinput oleh user pada filter
  	}
    
  	public function view_by_month($month, $year){
		$this->db->select("*");
		$this->db->from('penerimaan');
		$this->db->join('detail_penerimaan','detail_penerimaan.id_penerimaan=penerimaan.id_penerimaan');
		// $this->db->join('supplier','detail_penerimaan.id_supplier=supplier.id_supplier');
		$this->db->join('bahanbaku_utama','detail_penerimaan.kode_bb=bahanbaku_utama.kode_bb');
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
		$this->db->join('bahanbaku_utama','detail_penerimaan.kode_bb=bahanbaku_utama.kode_bb');
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        
    return $this->db->get()->result(); // Tampilkan data penerimaan sesuai tahun yang diinput oleh user pada filter
  	}
    
  	public function view_all(){
		$this->db->select("*");
		$this->db->from('penerimaan');
		$this->db->join('detail_penerimaan','detail_penerimaan.id_penerimaan=penerimaan.id_penerimaan');
		// $this->db->join('supplier','detail_penerimaan.id_supplier=supplier.id_supplier');
		$this->db->join('bahanbaku_utama','detail_penerimaan.kode_bb=bahanbaku_utama.kode_bb');
    return $this->db->get()->result(); // Tampilkan semua data penerimaan
  	}
    
    public function option_tahun(){
        $this->db->select('YEAR(tanggal) AS tahun'); // Ambil Tahun dari field tgl
		$this->db->from('penerimaan'); // select ke tabel penerimaan
		$this->db->join('detail_penerimaan','detail_penerimaan.id_penerimaan=penerimaan.id_penerimaan');
		// $this->db->join('supplier','detail_penerimaan.id_supplier=supplier.id_supplier');
		$this->db->join('bahanbaku_utama','detail_penerimaan.kode_bb=bahanbaku_utama.kode_bb');
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