<script type="text/javascript">
     $(function(){
         Lobibox.notify('info', {
                    position: 'bottom bottom', 
                    title: '<h2>E-Rapor </h2> <?= cari('nama_sekolah') ?>', 
                    img: '<?= base_url('assets/home/').'/'.cari('gambar'); ?>',
                    size: 'large',
                    msg: '<?= cari('alamat_sekolah') ?>'
                });
});
</script>

 
 <div class="row">
  <br /><br />

<?php if($this->session->userdata('level') == "admin" OR $this->session->userdata('level') == "operator"): ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $data_guru->num_rows() ?></h3>
              <p>Data Guru</p>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> 
       <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $data_nilai->num_rows() ?></h3>
              <p>Data Nilai</p>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $data_siswa->num_rows() ?></h3>
              <p>Data Siswa</p>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
             <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $data_mapel->num_rows() ?></h3>
              <p>Data Matapelajaran</p>
            </div>
            <div class="icon">
              <i class="fa fa-clone"></i>
            </div>
             <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>        
<?php elseif($this->session->userdata('level') == "guru"): ?>
       <div class="callout callout-info">HY <?= ucfirst(strip_tags($this->session->userdata('nama'))) ?></div>
       <hr />


<?php endif; ?>

 <div class="col-md-6">
  <div class="callout callout-warning"><i class="fa fa-user"></i>&nbsp;&nbsp;Detail Login User.</div>
    <section class="content">
      <div class="row">
 <?= $this->session->flashdata('pesan') ?>
 <div class="clearfix"></div>
 <hr />
   <div class="box box-info">
            <div class="box-header with-border">
            </div>
            <div class="box-body">
           <table class="table table-striped">
             <tr><th>Username</th><td><?= $data->row()->username ?></td></tr>
             <tr><th>Nama</th><td><?= $data->row()->nama ?></td></tr>
             <tr><th>Log Akses</th><td><?= $data->row()->log ?></td></tr>
           </table>           
            </div>
          </div>
      </div>
      <!-- /.row -->
      

    </section>
</div>

<div class="col-md-6">
<div class="callout callout-info"><i class="fa fa-list"></i>&nbsp;&nbsp;Identitas Sekolah.</div>

  <div class="box box-info">
            <div class="box-header with-border">
            </div>
            <div class="box-body">
<table class="table table-striped">
  
  <tr><th>Nama Sekolah</th><td><?= cari('nama_sekolah') ?></td></tr>
  <tr><th>Visi Dan Misi</th><td><?= cari('misi_visi') ?></td></tr>
  <tr><th>Alamat Sekolah</th><td><?= cari('alamat_sekolah') ?></td></tr>

</table>
</div> 
</div> 
</div> 


</div> 