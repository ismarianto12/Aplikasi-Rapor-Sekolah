<?php
 
class admin extends CI_controller
{
  
  function __construct()
  {
   parent::__construct();
   // error_reporting(0);
   if($this->session->userdata('login') == FALSE){
    redirect(base_url(''));
    exit();
   }
   $this->load->model('m_admin');
   $this->load->model('m_guru');
  }

  private function tpl($isi,$sql){
    $this->load->view('header',$sql);
    $this->load->view($isi);
    $this->load->view('footer');
  }

    public function index()
    {
     $x['data_nilai']=$this->db->get('nilai');
     $x['data_guru'] =$this->db->get('guru');
     $x['data_siswa']=$this->db->get('siswa');
     $x['data_mapel']=$this->db->get('mata_pelajaran');

    if($this->session->userdata('level') == "admin" OR $this->session->userdata('level') == "operator"):
       $x['data'] =$this->db->get_where('admin',array('id_admin'=>$this->session->userdata('id_admin')));
    elseif($this->session->userdata('level') == "guru"):
      $x['data'] =$this->db->get_where('guru',array('id_guru'=>$this->session->userdata('id_guru')));
    endif;
    if($this->session->userdata('level') == "guru"):
      $x['judul']="Selamat Datang Di Halaman Administrasi Guru";
    elseif($this->session->userdata('level') == "admin" OR $this->session->userdata('level') == "operator"):
      $x['judul']="Selamat Datang Di Halaman Administrator";

    endif;  
    $this->tpl('home',$x);
    }
     
    public function guru()
    {
    $x['data']=$this->db->get('guru')->result_array();
    $x['judul']="Data Guru"; 
    $x['depan']  = FALSE;  
    $this->tpl('admin/guru',$x);   
    } 

    public function guru_tambah()
    {

    $x['nip'] ="";      
    $x['judul']="Tambah Guru";   
    $x['aksi']="tambah";
    $x['nama']=""; 
    $x['username']=""; 
    $x['email']="";   
    $x['jenis_kelamin']="";   
    $x['foto']="";
     if (isset($_POST['kirim'])) {
  
$this->form_validation->set_rules('username', 'Username', 'trim|required|
                                    is_unique[admin.username]|is_unique[guru.username]');
$this->form_validation->set_rules('password', 'Password','trim|required');

 if ($this->form_validation->run() == TRUE){

    $nama_f = "nama" . time();
    $config['upload_path'] = './assets/file/';
    $config['allowed_types'] = 'png|jpg';
    $config['file_name'] = $nama_f;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if ($this->upload->do_upload('foto')) {
        
$data=array( 
'nama'=>$this->input->post('nama'),
'nip'=>$this->input->post("nip"),
'jenis_kelamin'=>$this->input->post("jenis_kelamin"),
'foto'=>$this->upload->file_name,
'username'=>$this->input->post("username"),
'password'=>md5($this->input->post("password")),
'email'=>md5($this->input->post("password")),
'r_pass'=>$this->input->post("password"),
'jenis_kelamin'=>$this->input->post("jenis_kelamin"));

$sql=$this->db->insert('guru',$data);
if($sql){
   redirect(base_url('admin/guru'));
}else{
  buat_aleert('GAGAL');
}

    }else{
     echo  $this->upload->display_errors();
    }

}else{
 buat_alert("USERNAME DAN PASSWORD TELAH DIGUNAKAN"); 
}


        }else{
        $this->tpl('admin/guru_form',$x); 
        }
    }



    public function guru_edit($id='')
    {

    $rt=$this->db->get_where('guru',array('id_guru'=>$id))->row_array();    
     $x['judul']="Edit Guru";   
     $x['aksi']="edit";
     $x['username']=$rt['username'];   
     $x['email']=$rt['email'];   
     $x['nama']=$rt['nama'];   
     $x['nip'] =$rt['nip'];
     $x['jenis_kelamin']="";   
     $x['gambar']=$rt['foto'];
     if (isset($_POST['kirim'])) {
    
$this->form_validation->set_rules('password','Username','required');
if ($this->form_validation->run() == FALSE) {
   $this->session->set_flashdata('pesan',validation_error('<div class="callout callout-warning">','</div>'));
   redirect(base_url('admin/guru'));
}else{

    $nama_f = "nama" . time();
    $config['upload_path'] = './assets/file/';
    $config['allowed_types'] = 'png|jpg';
    $config['file_name'] = $nama_f;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if ($this->upload->do_upload('foto')) {

    $data=$this->db->get_where('guru',array('id_guru'=>$id))->row_array();
    if(!empty($data['foto'])){
    @unlink('assets/file/'.$data['foto']);
    }else{
    }
                
$data=array( 
'nama'=>$this->input->post('nama'),
'jenis_kelamin'=>$this->input->post("jenis_kelamin"),
'foto'=>$this->upload->file_name,
'username'=>$this->input->post("username"),
'password'=>md5($this->input->post("password")),
'email'=>md5($this->input->post("password")),
'r_pass'=>$this->input->post("password"),
'jenis_kelamin'=>$this->input->post("jenis_kelamin"));

    $sql=$this->db->update('guru',$data,array('id_guru'=>$id));
    if($sql){
       redirect(base_url('admin/guru'));
    }else{
      buat_alert('GAGAL');
    }
    }else{
      buat_alert('Gambar/Foto Tidak Valid Silahkan Ualng');
    }
}
    }else{
    $this->tpl('admin/guru_form',$x); 
    }

    }

    public function guru_hapus($id='')
    {
      $data=$this->db->get_where('guru',array('id_guru'=>$id))->row_array();
      if(!empty($data['foto'])){
        @unlink('assets/file/'.$data['foto']);
      }else{
        
      }
      $hapus.=$this->db->delete('guru',array('id_guru'=>$id));
      $hapus.=$this->db->delete('nilai',array('id_guru'=>$id));
      $hapus.=$this->db->delete('mata_pelajaran',array('id_guru'=>$id));

      if($hapus){
        $this->session->set_flashdata('pesan','<div class="callout callout-warning">Data Berhasil Di Hapus</div>');
        redirect(base_url('admin/guru'));
      }
    }

//mata pelajaran
    public function mapel()
    {
    $x['data'] =$this->m_admin->mapel()->result_array();    
    $x['judul']="Manajemen Data Mata Pelajaran";  
    $this->tpl('admin/mapel',$x);
    }

    public function mapel_tambah()
    {
    
    $x = array('kode' =>'' ,'nama_mapel'=>'','ta_akademik'=>'');    
    $x['kelas']   = $this->db->get('kelas')->result_array();
    $x['guru']    = $this->db->get('guru')->result_array();
         
    $x['judul']="Data Mata Pelajaran";
    if(isset($_POST['kirim'])){ 
  
  $kode       = $this->input->post('kode');
  $kelas      = $this->input->post('kelas');
  $nama_mapel = $this->input->post("nama_mapel");
  $semester   = $this->input->post("semester");
  $id_guru    = $this->input->post("id_guru");
     
    $data = array(
    'kode' =>$kode,
    'id_kelas' =>$kelas,
    'nama_mapel' =>$nama_mapel,
    'semester' =>$semester,
    'id_guru' =>$id_guru,
    'ta_akademik'=>$this->input->post('ta_akademik')); 

    $data=$this->db->insert('mata_pelajaran',$data);
    if($data){
      $this->session->set_flashdata('pesan','<div class="">Berhasil Di Tambahkan</div>');
      redirect(base_url('admin/mapel'));
    }else{
       buat_aleert('GAGAL MENAMBAHKAN DATA');
    }

    }else{
      
    $this->tpl('admin/mapel_form',$x);

    }   
        
    }

    public function mapel_edit($id='')
    {
    if(empty($id)) redirect(base_url('admin/mapel'));
    $cek =$this->db->get_where('mata_pelajaran',array('id_mata_pelajaran'=>$id));
    if($cek->num_rows() > 0){
    $x['kode']= $cek->row()->kode;  
    $x['nama_mapel']= $cek->row()->nama_mapel;
    $x['ta_akademik']=$cek->row()->ta_akademik;
    $x['kelas']= $this->db->get('kelas')->result_array();
    $x['guru']    = $this->db->get('guru')->result_array();
        
    $x['judul']="Data Mata Pelajaran";
    if(isset($_POST['kirim'])){ 
    
   
  $kode       = $this->input->post('kode');
  $kelas      = $this->input->post('kelas');
  $nama_mapel = $this->input->post("nama_mapel");
  $semester   = $this->input->post("semester");
  $id_guru    = $this->input->post("id_guru");
     
   $data = array(
    'kode' =>$kode,
    'id_kelas' =>$kelas,
    'nama_mapel' =>$nama_mapel,
    'semester' =>$semester,
    'id_guru' =>$id_guru,
    'ta_akademik'=>$this->input->post('ta_akademik')); 

    $data=$this->db->update('mata_pelajaran',$data,array('id_mata_pelajaran'=>$id));
    if($data){
      $this->session->set_flashdata('pesan','<div class="callout callout-info">Berhasil Di Tambahkan</div>');
      redirect(base_url('admin/mapel'));
    }else{
       buat_aleert('GAGAL MENAMBAHKAN DATA');
    }

    }else{
        
    $this->tpl('admin/mapel_form',$x);

    }  
    }else{
      redirect(base_url('404'));
      exit();
    } 
    }

    public function mapel_hapus($id='')
    {
      if(empty($id)) redirect(base_url('admin/mapel'));
      $sq=$this->db->delete('mata_pelajaran',array('id_mata_pelajaran'=>$id));
      if($sq){
       $this->session->set_flashdata('pesan','<div class="alert aler-warning">Data Berhasil Di Hapus</div>'); 
       redirect(base_url('admin/mapel'));
      }else{
        buat_aleert('ERROR');
      }
    }
    

    public function siswa($value='')
    {
     $x['data']=$this->m_admin->siswa()->result_array();
     $x['judul']="Data Siswa";
     $x['depan']  = FALSE;    
     $this->tpl('admin/siswa',$x); 
    }
    
    public function siswa_tambah($value='')
    {
     $x['kelas'] =$this->db->get('kelas')->result_array();
    $x['judul']="Tambah Siswa";    
    $x['aksi']="tambah";
    $x['nama']="";
    $x['nisn']="";
    $x['jk']="";
    $x['nama_orang_tua']="";
    $x['gambar']="";
  

     if (isset($_POST['kirim'])) {
    
$this->form_validation->set_rules('nip','Nisn','required|is_unique[siswa.nisn]');
$this->form_validation->set_rules('nama','Nama Siswa','required');

if($this->form_validation->run() == FALSE){
   $this->session->set_flashdata('pesan',validation_errors('<div class="callout callout-warning">','</div>'));
   redirect(base_url('admin/siswa'));
}else{

    $nama_f = "nama" . time();
    $config['upload_path'] = './assets/file/';
    $config['allowed_types'] = 'png|jpg';
    $config['file_name'] = $nama_f;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if ($this->upload->do_upload('foto')) {
        
$data=array( 
'nama_s'=>$this->input->post('nama'),
'nisn'=>$this->input->post("nip"),
'jk'=>$this->input->post("jenis_kelamin"),
'nama_orang_tua'=>$this->input->post("nama_orang_tua"),
'kelas'=>$this->input->post("kelas"),
'semester'=>$this->input->post("semester"),
'foto'=>$this->upload->file_name);

$sql=$this->db->insert('siswa',$data);
if($sql){
   $this->session->set_flashdata('pesan','<div class="callout callout-info">Data Berhasil Di Tambahkan .</div>');
   redirect(base_url('admin/siswa'));
}else{
  buat_aleert('GAGAL');
}
  }else{
   $this->session->set_flashdata('pesan',$this->upload->display_errors('<div class="callout callout-info"></div>'));
   redirect(base_url('admin/siswa'));
  }
  }
        }else{
        $this->tpl('admin/siswa_form',$x); 
        }   
    }


public function siswa_edit($id='')
{
 if(empty($id)) redirect(base_url('admin/siswa'));
 $t=$this->db->get_where('siswa',array('id_siswa'=>$id))->row_array();
 
    $x['judul']="Tambah Siswa";    
    $x['aksi']="edit";
    $x['nama']=$t['nama_s'];
    $x['nisn']=$t['nisn'];
    $x['jk']=$t['jk'];
    $x['nama_orang_tua']=$t['nama_orang_tua'];
    $x['gambar']=$t['foto'];
    $x['kelas']=$this->db->get('kelas')->result_array();
     if (isset($_POST['kirim'])) {
    
$this->form_validation->set_rules('nip','Nisn','required|is_unique[siswa.nisn]');
$this->form_validation->set_rules('nama_s','Nama Siswa','required');

if($this->form_validation->run() == TRUE){
   $this->session->set_flashdata('pesan',validation_errors('<div class="callout callout-warning">','</div>'));
   redirect(base_url('admin/siswa'));
}else{

    $nama_f = "nama" . time();
    $config['upload_path'] = './assets/file/';
    $config['allowed_types'] = 'png|jpg';
    $config['file_name'] = $nama_f;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if ($this->upload->do_upload('foto')) {
        
$data=array( 
'nama_s'=>$this->input->post('nama'),
'nisn'=>$this->input->post("nip"),
'jk'=>$this->input->post("jenis_kelamin"),
'nama_orang_tua'=>$this->input->post("nama_orang_tua"),
'kelas'=>$this->input->post("kelas"),
'semester'=>$this->input->post("semester"),
'foto'=>$this->upload->file_name);

$sql=$this->db->update('siswa',$data,array('id_siswa'=>$id));
if($sql){
   $this->session->set_flashdata('pesan','<div class="callout callout-warning">Data Berhasil Di Update</div>'); 
   redirect(base_url('admin/siswa'));
}else{
  buat_aleert('GAGAL');
}

    }else{
     
   $this->session->set_flashdata('pesan',$this->upload->display_errors('<div class="callout callout-warning">','</div>'));
   redirect(base_url('admin/siswa'));
    }
  }
        }else{
        $this->tpl('admin/siswa_form',$x); 
        }   
}


    public function siswa_hapus($id='')
    {
      $data=$this->db->get_where('siswa',array('id_siswa'=>$id))->row_array();
      if(!empty($data['foto'])){
        @unlink('assets/file/'.$data['foto']);
      }else{
        
      }
      $hapus=$this->db->delete('siswa',array('id_siswa'=>$id));
      if($hapus){
        $this->session->set_flashdata('pesan','<div class="callout callout-warning">Data Berhasil Di Hapus</div>');
        redirect(base_url('admin/siswa'));
      }
    }


public function kelas()
{
 $x['data']=$this->db->get('kelas')->result_array();   
 $x['judul']="Data Kelas";
 $this->tpl('admin/kelas',$x);
}

public function kelas_tambah($value='')
{
if (isset($_POST['kirim'])) {
$data=array(
'nama_kelas'=>$this->input->post('nama_kelas'),
'ket'=>$this->input->post('ket'));

$cek=$this->db->get_where('kelas',array('nama_kelas' =>$this->input->post('nama_kelas'),
                                        'ket' =>$this->input->post('ket')));

if($cek->num_rows() > 0 ){
  buat_alert('GAGAL NAMA KELAS TELAH ADA SEBELUMNYA');
}else{
$hasil=$this->db->insert('kelas',$data);
if($hasil){
  $this->session->set_flashdata('pesan','<div class="callout callout-warning">Data Berhasil Ditambahakan</div>');
  redirect(base_url('admin/kelas'));
}else{
  buat_alert('GAGAL');
}
}

}else{
 $x['judul']="Tambah Kelas";
 $this->tpl('admin/kelas_form',$x);
  }
}

public function kelas_edit($id='')
{
if(empty($id)) redirect(base_url('admin/kelas'));

if (isset($_POST['kirim'])) {
$data=array(
'nama_kelas'=>$this->input->post('nama_kelas'),
'ket'=>$this->input->post('ket'));

$cek=$this->db->get_where('kelas',array('nama_kelas' =>$this->input->post('nama_kelas'),
                                        'ket' =>$this->input->post('ket')));

if($cek->num_rows() > 0 ){
buat_alert('GAGAL NAMA KELAS TELAH ADA SEBELUMNYA');
}else{
$hasil=$this->db->update('kelas',$data,array('id_kelas'=>$id));
if($hasil){
  $this->session->set_flashdata('pesan','<div class="callout callout-warning">Data Berhasil Ditambahakan</div>');
  redirect(base_url('admin/kelas'));
}else{
  buat_aleert('GAGAL');
}

}

}else{
 $x['judul']="Tambah Kelas";
 $this->tpl('admin/kelas_form',$x);
  } 
}

public function kelas_hapus($id='')
{
  $sql=$this->db->delete('kelas',array('id_kelas' =>$id));
  if($sql){
   redirect(base_url('admin/kelas'));
  }else{

  }
}

public function data_user()
{
 $x['user']=$this->db->get('admin')->result_array();   
 $x['judul']="Data Hak Akases";   
 $this->tpl('admin/user',$x);
}

public function user_tambah()
{
$x['username']="";
$x['password']="";
$x['nama']="";
$x['aksi'] ="user";
$x['level']="";
 $x['judul']=":::Tambah Hak Akses";   
 if (isset($_POST['kirim'])) {  
$this->form_validation->set_rules('username','Username','required|is_unique[admin.username]');
$this->form_validation->set_rules('username','Username','required|is_unique[guru.username]');
$this->form_validation->set_rules('nama','Nama','required');
$this->form_validation->set_rules('password','Password','required');
if($this->form_validation->run() == FALSE){

 $this->session->set_flashdata('pesan',validation_errors('<div class="callout callout-success">','</div>'));
 redirect(base_url('admin/user_form'));
}else{

$data=array(
'username'=>$this->input->post("username"),
'password'=>md5($this->input->post("password")),
'nama'=>$this->input->post("nama"),
'level'=>$this->input->post("level"));

$sql=$this->db->insert('admin',$data);
if($sql){
  $this->session->set_flashdata('pesan','<div class="callout callout-success">Data Berhasil Ditambahakan</div>');
  redirect(base_url('admin/data_user'));
}else{
  buat_alert('GAGAL SQL ');
}
}
 }else{
  $this->tpl('admin/user_form',$x);
 }
}

public function edit_user($id)
{
if(empty($id)) redirect(base_url('admin/user'));    
$q=$this->db->get_where('admin',array('id_admin'=>$id))->row_array(); 
$x['username']=$q['username'];
$x['password']="";
$x['nama']=$q['nama'];
$x['aksi'] ="user";
$x['level']=$q['level'];
 $x['judul']=":::Edit Hak Akses";   
 if (isset($_POST['kirim'])) {  

$this->form_validation->set_rules('username','Username','required|is_unique[admin.username]');
$this->form_validation->set_rules('username','Username','required|is_unique[guru.username]');
$this->form_validation->set_rules('nama','Nama','required');
$this->form_validation->set_rules('password','Password','required');
if($this->form_validation->run() == FALSE){

 $this->session->set_flashdata('pesan',validation_errors('<div class="callout callout-success">','</div>'));
 redirect(base_url('admin/user_form'));
}else{

$data=array(
'username'=>$this->input->post("username"),
'password'=>md5($this->input->post("password")),
'nama'=>$this->input->post("nama"),
'level'=>$this->input->post("level"));

$sql=$this->db->update('admin',$data,array('id_admin'=>$id));
if($sql){
  redirect(base_url('admin/data_user'));
}else{
  buat_alert('GAGAL SQL ');
}
}
 }else{
  $this->tpl('admin/user_form',$x);
 }
}


public function hapus_user($id)
{
 if($this->session->userdata('id_admin') == $id ){
   $this->session->set_flashdata('pesan','<div class="callout callout-warning">Anda Tidak Dapat Mengahapus Diri Anda Sendiri</div>');
   redirect(base_url('admin/data_user/'));
 }else{ 
 $sql=$this->db->delete('admin',array('id_admin'=>$id));
 if($sql){
    $this->session->set_flashdata('pesan','Data Berhasil Di Hapus');
    redirect(base_url('admin/data_user'));
 }
}
}
public function keluar()
{
 $this->session->sess_destroy();
 redirect(base_url('/?gos=lg'));
}

public function edit_profil()
{
if($this->session->userdata('level') == "admin" OR $this->session->userdata('level') == "operator"): 
  $sql=$this->db->get_where('admin',array('id_admin'=>$this->session->userdata('id_admin')))->row_array(); 
 elseif($this->session->userdata('level') == "guru"):
  $sql=$this->db->get_where('guru',array('id_guru'=>$this->session->userdata('id_guru')))->row_array(); 
 else:
  $sql=$this->db->get_where('admin',array('id_admin'=>$this->session->userdata('id_admin')))->row_array(); 
 endif; 
   $x['aksi'] ="profil";
  $x['judul']="Edit Profil";
  $x['username']=$sql['username'];
  $x['nama']=$sql['nama'];
  if(isset($_POST['kirim'])){

$this->form_validation->set_rules('username','Username','required|is_unique[admin.username]|is_unique[guru.username]');
if($this->form_validation->run() == TRUE){

    $data = array('username' =>$this->input->post('username'),
                  'password' =>md5($this->input->post('password')),
                  'nama' =>$this->input->post('nama'));

if($this->session->userdata('level') == "admin" OR $this->session->userdata('level') == "operator"): 
   $q=$this->db->update('admin',$data,array('id_admin'=>$this->session->userdata('id_admin')));
 elseif($this->session->userdata('level') == "guru"):
   $q=$this->db->update('guru',$data,array('id_guru'=>$this->session->userdata('id_guru')));
 else:
  $q=$this->db->update('admin',$data,array('id_admin'=>$this->session->userdata('id_admin')));
 endif; 
    if($q){
      $this->session->set_flashdata('pesan','<div class="callout callout-warning">Data BErhasil Di Edit</div>');
      redirect(base_url('admin/edit_profil'));
    }else{
    }
  }else{
     $this->session->set_flashdata('pesan','<div class="callout callout-danger">Username Telah Di Pakai </div>');
     redirect(base_url('admin/edit_profil'));
  }
  }else{
     $this->tpl('admin/user_form',$x);
  }

}

public function data_nilai()
  {
     if($this->session->userdata("level") != "guru"):
    $x['kelas']=$this->db->get('kelas'); 
   else:
    $id=$this->session->userdata('id_guru');
    $x['kelas'] =$this->m_admin->kelas($id); 
   endif; 
  $x['judul']="Data Nilai Siswa Telah Di SET";
   if(isset($_POST['kirim'])){
    $kelas=$this->input->post('kelas');
    $semester=$this->input->post('semester');
if($this->session->userdata('level') == "admin" OR $this->session->userdata('level') == "operator"){
    $x['data']=$this->m_admin->nilai($kelas,$semester)->result_array(); 
}elseif($this->session->userdata('level') == "guru"){
     $id_guru=$this->session->userdata('id_guru');
    $x['data']=$this->m_admin->nilai_sess($id_guru,$kelas,$semester)->result_array(); 
}
 $x['judul']="Data Nilai Siswa Telah Di SET";
      $this->tpl('guru/penilaian',$x);
  }else{
      $this->tpl('guru/cari_kelas',$x);
  }
}


  public function penilaian()
  {
   if($this->session->userdata("level") != "guru"):
    $x['kelas']=$this->db->get('kelas'); 
   else:
    $id=$this->session->userdata('id_guru');
    $x['kelas'] =$this->m_admin->kelas($id); 
   endif; 

   $x['judul']="Mata Pelajaran Yang Terdaftar";
   if(isset($_POST['kirim'])){
    $kelas=$this->input->post('kelas');
    $semester=$this->input->post('semester');
if($this->session->userdata('level') == "admin" OR $this->session->userdata('level') == "operator"){
   $x['data']=$this->m_admin->mapel_guru($kelas,$semester);  
}elseif($this->session->userdata('level') == "guru"){
  $id_guru=$this->session->userdata('id_guru');
  $x['data'] =$this->m_admin->mapel_guru_sess($id_guru,$kelas,$semester);
}    
  $x['status'] =$this->m_admin->cek_siswa($semester,$kelas);
  $x['siswa']  =$this->m_admin->dapatkan_siswa($kelas,$semester);
    $this->tpl('guru/mapel',$x);
   }else{
    $this->tpl('guru/cari_kelas',$x);
   }
  }

  public function penilaian_set($id,$semester)
  {
    if(empty($id)) redirect(base_url('guru/penilaian'));
      $data=$this->m_admin->penilaian_set($id,$semester);
 if($data->num_rows() > 0){

 if($this->session->userdata('level') == "guru"):
        if($this->session->userdata('id_guru') != $data->row()->id_guru){
         echo "Ada Belum Terdaftar Sebagai Guru Pada Mata Pelajaran Ini. : )";
         $this->db->close();
         exit();
       }else{

       }
 else:
endif;


$x['nilai']="";
$x['nu']="";
$x['nj']="";
$x['nt']="";
$x['kkm']="";
$x['nilai']="";
$x['id_mata_pelajaran']=$data->row()->id_mata_pelajaran;
$x['id_guru']=$data->row()->id_guru;
$x['semester']=$data->row()->semester;
$x['id_kelas']=$data->row()->id_kelas;
$x['kelas'] = $this->db->get_where('kelas',array('id_kelas'=>$data->row()->id_kelas));
$x['siswa'] = $this->m_admin->data_siswa_nilai($data->row()->id_kelas,$data->row()->semester);
if(isset($_POST['kirim'])){

$this->form_validation->set_rules('id_siswa','Siswa','required');
$this->form_validation->set_rules('nj','Nilai Ujian','required');

if($this->form_validation->run() == FALSE){
   $this->session->set_flashdata('pesan',validation_errors('<div class="callout callout-danger">','</div>'));
   redirect(base_url('penilaian_set/'.$id.'/'.$semester));
}else{

$semester=$this->input->post("semester");
$id_siswa=$this->input->post("id_siswa");
$cek=$this->db->get_where('nilai',array('semester'=>$semester));
$nilai=$this->db->get_where('nilai',array('id_siswa'=>$id_siswa));
$hasil=$nilai->row_array();


$siswa_cek=$this->m_admin->cek_penilaian($id_siswa,$id,$semester);
if($siswa_cek->num_rows() > 0){  
    $this->session->set_flashdata('pesan','<div class="callout callout-danger">Data Telah Ada</div>');
    redirect(base_url('admin/penilaian_set/'.$id.'/'.$semester));
}else{

 $nj  = $this->input->post("nj");
 $nu  = $this->input->post("nu");
 $nt  = $this->input->post("nt");
 $kkm = $this->input->post("kkm");
 
 $hasil=($nj+$nu+$nt) / 3;

if($hasil == 100){
$nilai="Tuntas Paripurna";
}
if($hasil > $kkm){
$nilai="Tuntas Diatas KKM";
}
if($hasil >= $kkm){
$nilai="Tuntas KKM";
}
if($hasil == $kkm){
$nilai="KKM (Krikteria Ketuntasan Minimal)";
}
if($hasil < $kkm ){
 $nilai="Gagal";
}
 
 $data=array(
'ket_nilai'=>$nilai,
'id_mata_pelajaran'=>$this->input->post("id_mata_pelajaran"),
'nilai'=>$this->input->post("nilai"),
'id_siswa'=>$this->input->post("id_siswa"),
'id_guru'=>$this->input->post("id_guru"),
'semester'=>$this->input->post("semester"),
'id_kelas'=>$this->input->post("id_kelas"),
'nj'=>$this->input->post("nj"),
'nu'=>$this->input->post("nu"),
'nt'=>$this->input->post("nt"),
'kkm'=>$this->input->post("kkm"),
'nilai'=>$hasil
);

$sql=$this->db->insert('nilai',$data);
if($sql){
  $this->session->set_flashdata('pesan','<div class="callout callout-warning">Nilai Berhasil Di Update Silahkan Lihat Data Nilai yang Di Set Pada Rekap Data Nilai</div>');  
  redirect(base_url('admin/penilaian/'));
}else{
  buat_alert('GAGAL');
}
}
}
    }else{ 
      $x['mata_pelajaran']=$data->row()->nama_mapel;
      $x['sudah']=$this->m_admin->sudah();
      $x['judul']="Administrator Guru";
      $x['aksi'] ="tambah_nilai";
      $this->tpl('guru/nilai_form',$x);
      }
    }else{
      show_error('Tidak Dapat Menerima Permintaan Yang Di Maksud');
      exit();
    }
  }
 

public function nilai_edit($id)
{
if(empty($id)) redirect(base_url('guru/penilaian'));  

$data=$this->db->get_where('nilai',array('id_nilai'=>$id));
if($data->num_rows() > 0){

 if($this->session->userdata('level') == "guru"):
        if($this->session->userdata('id_guru') != $data->row()->id_guru){
         redirect(base_url('404'));
         exit();
       }else{

       }
 else:
endif;


$data=$this->db->get_where('nilai',array('id_nilai'=>$id))->row_array();
$sql=$this->db->get_where('siswa',array('id_siswa'=>$data['id_siswa']));
$x['nama_siswa'] = $sql->row()->nama_s;
$x['mata_pelajaran']=$this->db->get_where('mata_pelajaran',array('id_mata_pelajaran'=>$data['id_mata_pelajaran']));
$x['nilai']=$data['nilai'];
$x['nu']=$data['nu'];
$x['nj']=$data['nj'];
$x['nt']=$data['nt'];
$x['kkm']=$data['kkm'];
$x['id_mata_pelajaran']=$data['id_mata_pelajaran'];
$x['id_guru']=$data['id_guru'];
$x['semester']=$data['semester'];
$x['id_kelas']=$data['id_kelas'];


if(isset($_POST['kirim'])){
$semester=$this->input->post("semester");
$id_siswa=$this->input->post("id_siswa");
$cek=$this->db->get_where('nilai',array('semester'=>$semester));
$nilai=$this->db->get_where('nilai',array('id_siswa'=>$id_siswa));
$hasil=$nilai->row_array();

if($hasil['id_mata_pelajaran'] != $this->input->post("id_mata_pelajaran")){  
    $this->session->set_flashdata('pesan','<div class="callout callout-danger">Nilai Sudah Ada.</div>');  
  redirect(base_url('admin/data_nilai'));
}else{

 $nj  = $this->input->post("nj");
 $nu  = $this->input->post("nu");
 $nt  = $this->input->post("nt");
 $kkm = $this->input->post("kkm");

 $hasil=($nj+$nu+$nt) / 4;

if($hasil == 100){
$nilai="Tuntas Paripurna";
}
if($hasil > $kkm){
$nilai="Tuntas Diatas KKM";
}
if($hasil >= $kkm){
$nilai="Tuntas KKM";
}
if($hasil == $kkm){
$nilai="KKM (Krikteria Ketuntasan Minimal)";
}
if($hasil < $kkm ){
 $nilai="Gagal";
}
 
 $data=array(
'ket_nilai'=>$nilai,
'id_mata_pelajaran'=>$this->input->post("id_mata_pelajaran"),
'nilai'=>$this->input->post("nilai"),
'id_guru'=>$this->input->post("id_guru"),
'semester'=>$this->input->post("semester"),
'id_kelas'=>$this->input->post("id_kelas"),
'nj'=>$this->input->post("nj"),
'nu'=>$this->input->post("nu"),
'nt'=>$this->input->post("nt"),
'kkm'=>$this->input->post("kkm"),
'nilai'=>$hasil
);

$sql=$this->db->update('nilai',$data,array('id_nilai'=>$id));
if($sql){
  $this->session->set_flashdata('pesan','<div class="callout callout-warning">Nilai Berhasil Di Update</div>');  
  redirect(base_url('admin/data_nilai'));
}else{
  buat_alert('GAGAL');
}

}

    }else{ 
    $id=$this->session->userdata('id_guru');  
    $x['mata_pelajaran']=$x['mata_pelajaran']->row()->nama_mapel;
    $x['data']=$this->m_guru->mapel_guru($id)->result_array();  
    $x['judul']="Administrator Guru";
    $x['aksi'] ="edit_nilai";
      $this->tpl('guru/nilai_form',$x);
    }

    }else{
 redirect(base_url('404'));
}
}


public function nilai_hapus($id='')
{
  $hasil=$this->db->delete('nilai',array('id_nilai'=>$id));
  if($hasil){
    $this->session->set_flashdata('pesan','<div class="callout callout-warning">Data Berhasil Di Hapus Silahkan Lihat Hasil Form Pada Pencarian Pilih Kelas Dan semester</div>');
    redirect(base_url('/admin/data_nilai'));
  }else{
    buat_alert('Gagal SQL ERROR');
  }
}

//bagian nilai rapoort siswa ;
public function raport()
{
 
 if($this->session->userdata('level') == "admin" OR $this->session->userdata('level') == "operator"):
 $x['kelas'] =$this->db->get('kelas');
 elseif($this->session->userdata('level') =="guru"):
   $id=$this->session->userdata('id_guru');
   $x['kelas'] =$this->m_admin->raport_kelas_guru($id);
  endif;


 $x['judul'] ="Cetak Rapor Siswa";
 if (isset($_POST['kirim'])) {

    $kelas=$this->input->post('kelas');
    $semester=$this->input->post('semester');
    $this->m_admin->cari_siswa($kelas,$semester);
    $x['data']=$this->m_admin->cari_siswa($kelas,$semester)->result_array();
    $this->tpl('admin/per_siswa',$x); 

  }else{
     $x['data'] ="";
    $this->tpl('admin/per_siswa',$x);
  } 
}

public function setting($action='',$id='')
{
  
if ($action == 'edit') {
if (empty($id)) {
   redirect(base_url('404')); 
};
$cek=$this->db->get_where('setting',array('parameter'=>$id));
if($cek->num_rows() > 0){
if (isset($_POST['kirim'])) {


if ($id == "gambar") {

   $config['upload_path'] ='assets/home/';
   $config['file_name'] =date('Y-m-d').'_12';
   $config['allowed_types'] ='png|jpg';
 $this->upload->initialize($config);
 if($this->upload->do_upload('gambar')){
  
  $data=$this->db->get_where('setting',array('parameter'=>$id));
  @unlink('.assets/home/'.$data->row()->nilai);
  $sql = array('nilai' =>$this->upload->file_name);
  $data=$this->db->update('setting',$sql,array('parameter'=>$id));
  if($data){
    $this->session->set_flashdata('pesan','<div class="callout callout-info">Data Berhasil Di edit.</div>');
    redirect(base_url('admin/setting'));
  }
}else{
     $this->session->set_flashdata('pesan',$this->upload->display_errors('<div class="callout callout-info">Data Berhasil Di edit.</div>'));
     redirect(base_url('admin/setting'));
 }
}elseif($id == 'favicon'){
   $config['upload_path']   = 'assets/home/';
   $config['file_name']     = date('Y-m-d').'_12';
   $config['allowed_types'] = 'png|jpg';
 
 $this->upload->initialize($config);
 if($this->upload->do_upload('favicon')){
  
  $data=$this->db->get_where('setting',array('parameter'=>$id));
  @unlink('.assets/home/'.$data->row()->nilai);
  $sql = array('nilai' =>$this->upload->file_name);
  $data=$this->db->update('setting',$sql,array('parameter'=>$id));
  if($data){
    $this->session->set_flashdata('pesan','<div class="callout callout-info">Data Berhasil Di edit.</div>');
    redirect(base_url('admin/setting'));
  }
 }else{
     $this->session->set_flashdata('pesan',$this->upload->display_errors('<div class="callout callout-info">','</div>'));
     redirect(base_url('admin/setting'));
 }
}else{
  $sql = array('nilai' =>$this->input->post('nilai'));
  $data=$this->db->update('setting',$sql,array('parameter'=>$id));
  if($data){
    $this->session->set_flashdata('pesan','<div class="callout callout-info">Data Berhasil Di edit.</div>');
    redirect(base_url('admin/setting'));
  }
}

 }else{
    $x['id'] =$id;
    $x['form'] ='y';
    $x['data'] =$cek;
    $x['judul'] ="Identitas Aplikasi";
    $this->tpl('admin/setting',$x);
  }
}else{
  show_error('Data Dengan Parameter Yang Di Maksud Belum Ada');
  exit();
}
}else{
    $x['form'] ='n';
    $x['data'] =$this->db->get('setting');
    $x['judul'] ="Identitas Aplikasi";
    $this->tpl('admin/setting',$x);
  }
}

public function rekap()
{
   if($this->session->userdata("level") != "guru"):
    $x['kelas']= $this->db->get('kelas'); 
   else:
    $id=$this->session->userdata('id_guru');
    $x['kelas'] = $this->m_admin->kelas($id); 
   endif; 
 $x['judul'] ="Rekap Nilai Akademik";  
 if (isset($_POST['kirim'])) {
    $kelas     = $this->input->post('kelas');
    $semester  = $this->input->post('semester');
    $x['data'] = $this->m_admin->rekap($kelas,$semester);
    $this->tpl('admin/rekap',$x);
 }else{
 $x['judul'] ="Rekap Data Nilai Akademik Sekolah"; 
 $this->tpl('guru/cari_kelas',$x);
}
}

public function rekap_data_nilai($id)
{
 if (empty($id)) {
    redirect(base_url('404'));
 }
 $cek=$this->m_admin->hasil_rekap($id);
 if($cek->num_rows() > 0){
 $x['pelajaran']  = $cek;
 $x['data'] = $this->m_admin->rekap_akadedmik($cek->row()->id_mata_pelajaran);
 $x['judul']="Hasil Rekapitulasi Nilai";
 $this->tpl('admin/hasil_rekap',$x);
}else{
 redirect(base_url('404'));
 exit();
}
}

public function cetak_rekap_data_nilai($id='')
{
   $x['judul'] = "Cetak Data Rekap Nilai";
   $x['data']  = $this->m_admin->cetak_rekap_data_nilai($id);
   $this->load->view('admin/cetak_rekap',$x);
}

public function dapatkan_siswa()
{
 $id=$this->input->post('id');
 $data=$this->db->get_where('siswa',array('id_siswa'=>$id))->result_array();
 echo json_encode($data);
}

}