<?php 
 
class Home extends CI_controller
{
   
	function __construct()
	{
	 parent:: __construct();	
   if($this->session->userdata('login') == TRUE){
    redirect(base_url('admin'));
   };
  
	 $this->load->model('m_site');
   $this->load->model('m_admin');
   $this->model=$this->m_site;
	 
	}

 

	public function index()
	{
	 $x['judul'] =".:: Selamat Datang Di ".cari('nama_sekolah').' ::.';
   $this->load->view('login',$x);
	}

  public function login($value='')
  {
 
    $username=barasiah($this->input->post('username'));
    $password=barasiah($this->input->post('password'));

    $cek_sql1=$this->model->m_login($username,md5($password));
    $cek_sql2=$this->model->m_login_guru($username,md5($password));

    if($cek_sql1->num_rows() > 0){
      //cek yang pertama jika ada lanjut dan sebalinknya;
    $hasil=$cek_sql1->row_array();  
    $data_login = array(
    'id_admin' =>$hasil['id_admin'] ,
    'username' =>$hasil['username'] ,
    'password' =>$hasil['password'] ,
    'level' =>$hasil['level'],
    'login' =>TRUE,
    );
      $this->session->set_userdata($data_login);
      echo "y";
    }elseif($cek_sql2->num_rows() > 0){
      
      //cek yang kedua jika ada lanjut dan sebalinknya;
    $has=$cek_sql2->row_array();  
    $guru = array(
    'id_guru' =>$has['id_guru'] ,
    'username' =>$has['username'] ,
    'nama' =>$has['nama'] ,
    'password' =>$has['password'] ,
    'level' =>'guru',
    'login' =>TRUE,
    );
       
      $this->session->set_userdata($guru);
      echo "y";

    }else{ 
      $this->session->sess_destroy();  
      echo "n";
    }

   
  }

}

