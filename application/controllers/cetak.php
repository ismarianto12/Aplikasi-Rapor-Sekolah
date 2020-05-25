<?php 

/**
* 
*/
class cetak extends CI_controller
{
	
	function __construct()
	{
     parent::__construct();
     $this->load->model('m_admin');
     error_reporting(0);
	}

	public function raport($id_siswa,$semester)
	{
	 $this->session->set_flashdata('pesan','<div class="callout callout-info">Kesalahan Tak Terduga</div>');
     if(empty($id_siswa) OR  empty($semester)) redirect(base_url('admin/raport'));
//jika kosong id_siswa dan kosong Id raport balek lagi 

     $x['rank']=$this->m_admin->raport($id_siswa,$semester)->num_rows();
if ($x['rank'] > 0) {
     $x['judul']="Daftar Nilai Kolektif Siswa";
     $sql=$this->m_admin->raport($id_siswa,$semester)->result_array();
     $x['data']= $this->m_admin->raport($id_siswa,$semester);
     $x['nama']= $sql[0]['nama_s'];
     $x['nisn']= $sql[0]['nisn'];
     $x['nama_kelas']=  $sql[0]['nama_kelas'];
     $x['ket']=  $sql[0]['ket'];
     $this->load->view('laporan/raport',$x);
  
	}else{
           $this->session->set_flashdata('pesan','<div class="callout callout-warning">Tidak Dapat Mencetak Data</div>');
     redirect(base_url('admin/raport'));
 
     }
}
}