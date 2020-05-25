<script type="text/javascript">
 $(function(){
  $('.cari_siswa').html('<input type="text" name="siswa" placeholder="cari siswa .." class="form-control">');	
  $('.cari_siswa').click(function(){
       $('#myModal').modal('show');
 $('.cari_siswa').html('<div class="callout callout-warning"><i class="fa fa-share fa-spin"></i>Sedang Memproses Data Harap Bersabar ..</div>');	
 $('#pilih_sis').click(function(){
          var id=$(this).val();
          $.ajax({
			url:"<?= base_url('admin/dapatkan_siswa') ?>",
			method : "POST",
			data : {id: id},
			async : false,
			dataType : 'json',
		    cahce :false,
		    selected:true,
		success: function(data){
	    $('#myModal').modal('hide');
        var i;
        for(i=0; i< data.length; i++){
           $('.cari_siswa').html('<input type="text" value="'+data[i].nama_s+'" class="form-control" disabled=""><input type="hidden" name="id_siswa" class="form-control" value="'+data[i].id_siswa+'">');
            }
          },
         error:function(data){
         	alert('server Not Connected');
         }

       });

     });  
  });     
  });  	 
</script>




<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title" id="myModalLabel"><i class="fa fa-list"></i>Data Siswa Kelas Kelas <b><?= $kelas->row()->ket ?>/<?= $kelas->row()->nama_kelas ?></b></h3>
                    </div>
                    <div class="modal-body">

<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nama Orang Tua</th>
                    <th>Foto</th>
                    <th>NISN</th>
                    <th>Jenis Kelamin</th>
                    <th>Kelas</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                    
                </tr>
                </thead>
                <tbody>
            <?php $no=1; foreach($siswa->result_array() as $hasil):
            if($hasil['semester'] == "1"):
             $sms="Semester Ganjil Satu";
            elseif ($hasil['semester'] == "2"): 
             $sms="Semester Genap Dua";
            endif;

            if($hasil['jk'] == "L"):
            $kelamin="Laki-laki";
            elseif ($hasil['P'] == "P"): 
            $kelamin="Perempuan";
            endif;

             ?>
            <tr>
            <td><?= $no; ?></td>
            <td><?= $hasil['nama_s']; ?></td>
            <td><?= $hasil['nama_orang_tua']; ?></td>
            <td><img src="<?= base_url('assets/file/'.$hasil['foto']) ?>" class="img-responsive" style="width:100px;height: 100px"></td>
            <td><?= $hasil['nisn']; ?></td>
            <td><?= $kelamin ?></td>
            <td><?= $hasil['nama_kelas'].''.$hasil['ket'] ?></td>
            <th><?= $sms ?></th>
            <td>
          <?php 
            $data=$this->db->get_where('nilai',array(
              'id_siswa'=>$hasil['id_siswa'],
              'id_mata_pelajaran'=>$id_mata_pelajaran ));       
            if($data->num_rows() > 0):
            	echo "<div class='callout callout-info'>Data Nilai Ini Telah Ada.</div>";
            else:
            	echo "<input type='radio' id='pilih_sis' name='pilih_siswa' value='".$hasil['id_siswa']."'>Pilih Data Siswa";
            endif; 	

             ?></td> 
 
            </tr>

           <?php $no++; endforeach; ?>


                </tbody>
                </table>

                    </div>
                </div>
            </div>
        </div>
        

<?php
 echo $this->session->flashdata('pesan');
		if($semester == "1"):
		$semester_="Semester Ganjil Satu";
		elseif ($semester == "2"): 
		$semester_="Semester Genap Dua";
		endif;
?>
 
<div class="callout callout-info"><p style="color: #fff">Mata Pelajaran Siswa  >> <b><?= $mata_pelajaran ?></b> >> <?= $semester_ ?>
</p>

</div>

<div class="callout callout-warning">Kelas <b><?= $kelas->row()->ket ?>/<?= $kelas->row()->nama_kelas ?></b></div>

<form action="" method="POST"> 
<table class="table table-striped">
<input type="hidden" name="id_mata_pelajaran" value="<?= $id_mata_pelajaran ?>" >
<input type="hidden" name="id_guru"     value="<?= $id_guru ?>" >
<input type="hidden" name="semester"     value="<?= $semester ?>">
<input type="hidden" name="id_kelas"     value="<?= $id_kelas ?>" >

 
 
<tr><th>Nilai Ujian</th>
<td>
<input type="number" name="nj" class="form-control" value="<?= $nj ?>" required="" max_length='3'></td></tr>
<tr><th>Nilai Tugas</th>
<td>
<input type="number" name="nt" class="form-control" value="<?= $nt ?>" required="" max_length='3'></td></tr>
<tr><th>Nilai Ulangan</th>
<td>
<input type="number" name="nu" class="form-control" value="<?= $nu ?>" required="" max_length='3'></td></tr>
<tr><th>KKM</th>
<td>
<input type="number" name="kkm" class="form-control" value="<?= $kkm ?>" required="" max_length='3'></td></tr>

<?php if($aksi == "edit_nilai"): ?>
  <tr><td>Nama Siswa Tidak Bisa Di Ubah</td><td><input type="text" value="<?= $nama_siswa ?>" class="form-control" disabled=""></td></tr>
<?php else: ?> 
<tr><td>Nama Siswa Yang Akan Di Beri Nilai</td><td><div class="cari_siswa"></div></td></tr>	
 <?php endif;  ?>


		<tr><td><button type="submit" class="btn btn-primary" name="kirim">
					<i class="glyphicon glyphicon-floppy-disk"></i> Simpan 
				</button>
				<a class="btn btn-warning" href="#">
					<i class="glyphicon glyphicon-arrow-left"></i> Batal 
				</a></td><td></td></tr>
		 
</table>
</form>

 <?php 

// }else{

// 	echo '<div class="callout callout-danger"><p style="color: #fff">

//        !! Maaf Tidak Ada Siswa Yang Terdaftar Pada Mata Pelajaran Ini Silahakan Lihat Data Siswa Yang Terdaftar 
//         Pada Mata Pelajaran Ini

// 	</p></div>';
// }


 ?>