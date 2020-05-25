<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= strip_tags($judul); ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="<?= base_url('assets/home/favicon.ico') ?>" type="image/x-icon" />
  <link rel="stylesheet" href="<?= base_url('assets/home') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/home') ?>/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/home') ?>/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/home') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 <script src="<?= base_url() ?>assets/home/ckeditor/ckeditor.js"></script>
 <script src="<?= base_url() ?>assets/home/ckeditor/styles.js"></script>
  <link rel="stylesheet" href="<?= base_url('assets/home') ?>/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/home') ?>/dist/css/skins/_all-skins.min.css">
 <link rel="stylesheet" href="<?= base_url('assets/home') ?>/dist/css/Lobibox.min.css"/>
 <script src="<?= base_url('assets/home') ?>/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]--> 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">



<script type="text/javascript">
   
   function keluar(){

swal({
  title: "Anda Yakin Untuk Keluar?",
  text: "Keluar Dari Halaman Administrasi Untuk Mengakhiri Session Anda ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Sedang mengalihkan", {
      icon: "success",
    });
   window.location.href = "<?= base_url('admin/keluar') ?>";

  } else {
 
    swal({
  title: "Anda Membatalkan Keluar Dari Halaman Administrator",
  icon: "success",
  button: "Tutup Dialog",
});
  }
});


   }


</script>

 <?php
 if($this->session->userdata('level') == "admin"):
  $admin=$this->db->get_where('admin',array('id_admin'=>$this->session->userdata('id_admin')))->result_array();
elseif($this->session->userdata('level') == "guru"):
    $admin=$this->db->get_where('guru',array('id_guru'=>$this->session->userdata('id_guru')))->result_array();
else:
  $admin=$this->db->get_where('admin',array('id_admin'=>$this->session->userdata('id_admin')))->result_array();
endif;

  ?> 

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>R</b>SI</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Administrator</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li><a href="<?= base_url() ?>" target="_blank">Preview</a></li>
          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php if($this->session->userdata('level') =="guru"): ?>
                <img src="<?= base_url('assets/file/'.$admin[0]['foto']) ?>" class="img-circle" alt="<?= $admin[0]['username'] ?>" style="width: 30px;height: 30px">
              <?php else: ?>
              
              <?php endif; ?>  
              <span class="hidden-xs"><?= strip_tags($admin[0]['nama']) ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
            <li class="user-header">
            <?php if($this->session->userdata('level') =="guru"): ?>
            <img src="<?= base_url('assets/file/'.$admin[0]['foto']) ?>" class="img-circle" alt="<?= $admin[0]['username'] ?>">
            <?php else: ?>
            
              <?php endif; ?>  
                <p>
                
                  <?= strip_tags($admin[0]['nama']) ?> - <?= $this->session->userdata('level'); ?>
                   <small>Login Sebelumnya <?= 
                       strip_tags($admin[0]['log'])

                   ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?= base_url('admin/edit_profil') ?>" class="btn btn-default btn-flat">Ubah Password</a>
                </div>
                <div class="pull-right">
                  <buitton onclick="return keluar()" class="btn btn-default btn-flat">Sign out</buitton>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
           
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
 
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
      <?php if($this->session->userdata('level') =="admin" ):  ?>

 <li><a href="<?= base_url('/admin/index') ?>"><i class="fa fa-dashboard text-aqua"></i> <span>Administrator</span></a></li>
 <li><a href="<?= base_url('/admin/guru') ?>"><i class="fa fa-book text-aqua"></i> <span>Data Guru</span></a></li>
 <li><a href="<?= base_url('/admin/siswa') ?>"><i class="fa fa-list text-aqua"></i> <span>Data Siswa</span></a></li>
 <li><a href="<?= base_url('/admin/kelas') ?>"><i class="fa fa-clone text-aqua"></i> <span>Data Kelas</span></a></li>
 <li><a href="<?= base_url('/admin/mapel') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Data Matapelajaran</span></a>

 </li>
    <li class="treeview">
    <a href="">
    <i class="fa fa-list"></i> <span>Set Nilai Raport </span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu"><li><a href="<?= base_url('admin/penilaian') ?>"><i class="fa fa-list text-aqua"></i> <span> Set Nilai Raport</span></a></li> </ul>
      </li>
    <li><a href="<?= base_url('admin/data_nilai') ?>"><i class="fa fa-list text-aqua"></i> <span>Data Nilai Rapor</span></a></li>
    <li><a href="<?= base_url('admin/rekap') ?>"><i class="fa fa-list text-aqua"></i> <span>Rekap Nilai Raport Sekolah</span></a></li>
    <li class="treeview">
    <a href="">
    <i class="fa fa-list"></i> <span>Cetak Raport</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu" style="display: none;"><li><a href="<?= base_url('/admin/raport') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Data Rapor </span></a></li> </ul>
      </li><li><a href="<?= base_url('/admin/setting') ?> "><i class="fa fa-wrench text-aqua"></i> <span>Setting Identitas Web</span></a></li><li><a href="<?= base_url('/admin/data_user') ?>"><i class="fa fa-list text-aqua"></i> <span>Hak Akses Administrator</span></a></li>     


<?php elseif($this->session->userdata('level') == "guru"): ?>
 <li><a href="<?= base_url('/admin/index') ?>"><i class="fa fa-dashboard text-aqua"></i> <span>Beranda </span></a></li>
<li class="treeview">
    <a href="">
    <i class="fa fa-list"></i> <span>Set Nilai Raport </span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu" style="display: none;"><li><a href="<?= base_url('/admin/penilaian') ?>"><i class="fa fa-list text-aqua"></i> <span> Set Nilai Raport</span></a></li> 
    </ul>
      </li>
    <li><a href="<?= base_url('/admin/data_nilai') ?>"><i class="fa fa-list text-aqua"></i> <span>Data Nilai Rapor</span></a></li>
    <li><a href="<?= base_url('admin/rekap') ?>"><i class="fa fa-list text-aqua"></i> <span>Rekap Nilai Raport Sekolah</span></a></li>

    <li class="treeview">
    <a href="">
    <i class="fa fa-book"></i> <span>Cetak Raport</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu" style="display: none;"><li><a href="<?= base_url('/admin/raport') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Data Nilai</span></a></li> </ul>
  </li>     


<?php elseif($this->session->userdata('level') == "operator"): ?>
   <li><a href="<?= base_url('/admin/index?ocx=yes') ?>"><i class="fa fa-dashboard text-aqua"></i> <span>Administrator</span></a></li>

     <li class="treeview">
    <a href="">
    <i class="fa fa-list"></i> <span>Set Nilai Raport </span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu"><li><a href="<?= base_url('admin/penilaian') ?>"><i class="fa fa-list text-aqua"></i> <span> Set Nilai Raport</span></a></li> </ul>
      </li>
    <li><a href="<?= base_url('admin/data_nilai') ?>"><i class="fa fa-list text-aqua"></i> <span>Data Nilai Rapor</span></a></li>
    <li><a href="<?= base_url('admin/rekap') ?>"><i class="fa fa-list text-aqua"></i> <span>Rekap Nilai Raport Sekolah</span></a></li>
    <li class="treeview">
    <a href="">
    <i class="fa fa-list"></i> <span>Cetak Raport</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu" style="display: none;"><li><a href="<?= base_url('/admin/raport') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Data Nilai Rapor </span></a></li> </ul>

 <?php endif;  ?>
     

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
  

   <hr />
      <h4>
         <div class="callout callout-info"><i class="fa fa-share"></i><?= $judul; ?></div>
      </h4>
       
      <ol class="breadcrumb">
        <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= strip_tags($judul) ?></li>
      </ol>

    </section>
    <section class="content">
    <div class="box">
    <div class="box-body">
  <?php
   if(isset($_GET['gos']) == "Berhasil"){
    if($this->session->userdata('admin') == "admin"):
     echo "<div class='callout callout-info'>Login Berhasil Sebagai Administrator Silahkan Gunakan Menu Di Samping Untuk Menggunakan Sistem.</div>";
   elseif($this->session->userdata('level') == "guru"):
     echo "<div class='callout callout-warning'>HY ".$this->session->userdata('nama')." Selamat Datang Di Administarsi Guru</div>";
   else:
     echo "<div class='callout callout-info'>Login Berhasil Sebagai User Silahkan Gunakan Menu Di Samping Untuk Menggunakan Sistem.</div>";
   endif;
   }else{


   }


   ?>