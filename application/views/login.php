<!-- source created by ismarianto putra -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $judul ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/bootstrap/css/bootstrap.min.css">
  <link rel="shortcut icon" href="<?= base_url('assets/home/').'/'.cari('favicon') ?>" type="image/x-icon" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url('assets/home') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/home') ?>/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/home') ?>/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/home') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/home') ?>/dist/css/AdminLTE.min.css">
  <script src="<?= base_url('assets/home') ?>/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url('assets/home') ?>/dist/js/adminlte.min.js"></script>
  <link rel="stylesheet" href="<?= base_url('assets/home') ?>/dist/css/Lobibox.min.css"/>
  <link rel="stylesheet" href="<?= base_url('assets/admin/dist') ?>/css/datepicker.css"> 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page" style="background: url(<?= base_url('assets/bg.jpeg') ?>); 
    background-size:cover;">
 <style type="text/css">
   @media (max-width:568px){
      .respon{
          width: 70px;
          height: 70px;     
      }
      .login-page{
    overflow: show;

     }
    }
    .respon{
       width: 130px;
       height: 130px;
    }
 </style>

 <script type="text/javascript">
   $(function(){

  Lobibox.notify('info', {
                    position: 'bottom bottom', 
                    title: '<h2>E-Rapor </h2> <?= cari('nama_sekolah') ?>', 
                    img: '<?= base_url('assets/home/').'/'.cari('gambar'); ?>',
                    size: 'large',
                    msg: '<?= cari('alamat_sekolah') ?>'
                });

  $('.notifikasi').hide();
  $('#login').submit(function(){
   $('.notifikasi').hide();
   if($('input[name=username]').val() == ""){
           Lobibox.notify('error', {
                    msg: "Username Tidak Boleh Kosong"
                });

      }else if($('input[name=password]').val() == ""){
            Lobibox.notify('error', {
                    msg: "Password Tidak Boleh Kosong"
                });

      }else{
        $.ajax({
            type : "POST",
            url : "<?= base_url('home/login') ?>",
            data : $(this).serialize(),
            success : function(data){
               if(data == 'y'){
                   Lobibox.notify('success', {
                    msg: "Login Berhasil Sedang Mengalihkan"
                });

                window.location = "admin/admin?gos=Berhasil"; 
               }else if(data){
               Lobibox.notify('error', {
                    msg: "Username Dan Password Salah"
                });
     }else{
     
   
     Lobibox.notify('error', {
                 msg: "Username Dan Password Salah"
                });

              }
             },
             error : function(data){

          Lobibox.notify('info', {
                 msg: "Maaf Untuk Semenetara Server Tidak Merespon ...."
                });

           }  
         });
 
     }
     return false;
  });

});


 </script>
 
 <div class="login-box">

         <div class="box box-primary">
            <div class="box-header with-border">

            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="login" class="form-horizontal">
             <div class="box-body">
              <p class="login-box-msg"> <span class="glyphicon glyphicon-user"></span>&nbsp;Silahkan login gunakan aplikasi</p>
                <div class="form-group has-feedback">
                  <div class="col-sm-12">
                    <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="Silahkan Masukan Username ..">
                     <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <div class="col-sm-12">
                   <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Silahkan Masukan Password ..">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                </div>
                <br />
        <div class="form-group">
        <div class="col-sm-12">
        <button name="login" class="btn btn-primary btn-block btn-flat"> <span class="fa fa-key"></span>Login</button> 
        </div>
          </div>
              </div>
            </form>
          </div>
 <?= $this->session->flashdata('msg') ?>
          <?php 

$pg=isset($_GET['gos']); 
if ($pg == "lg") {  
  echo "<div class='callout callout-danger'>And Berhasil Keluar Dari Halaman Administrator Silahkan Login Kembali Untuk Melanjutkan</div>";
}else{
   
}
?>
</div> 
<script src="<?= base_url('assets/home/dist/') ?>/js/Lobibox.js"></script>
</body>
</html>
