<?php
class m_bop extends CI_Model
{
    public function getID()
	{
		$sql = "SELECT (substring(IFNULL(MAX(id),0),5)+0) as hsl FROM daftar_bop";
		$query = $this->db->query($sql);
		$hasil = $query->result_array();
		foreach($hasil as $cacah):
		$jml_data = $cacah['hsl'];
		endforeach;
		$id = 'ID-';
		$nomor = str_pad(($jml_data+1),2,"0",STR_PAD_LEFT); //ID-001
		$id = $id.$nomor;
		return $id;
    }

    public function input_op()
    {
        $data = [
            'id' => $this->getID(),
            'penggunaan' => $this->input->post('penggunaan'),
            'daya_watt' => $this->input->post('daya'),
        ];
        $this->db->insert('daftar_bop', $data);
    }

    public function getDaftarBOP()
    {
        $this->db->select('*');
        $this->db->from('daftar_bop');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getIdDaftarBOP($id)
    {
        return $this->db->get_where('daftar_bop', array('id' => $id))->row_array();
    }

    public function updateDaftarBOP($id)
    {
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->penggunaan= $post["penggunaan"];
        $this->daya_watt = $post["daya"];
			
			$sql = "UPDATE daftar_bop";
			$sql = $sql." SET penggunaan = ".$this->db->escape($this->penggunaan).", daya_watt = ".$this->db->escape($this->daya_watt)."";
			$sql = $sql." WHERE id = ".$this->db->escape($this->id);
			$query = $this->db->query($sql);
			return $this->db->affected_rows();
    }
}
