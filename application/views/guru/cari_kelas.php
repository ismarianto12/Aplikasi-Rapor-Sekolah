<?= $this->session->flashdata('pesan') ?>
<?php if($this->session->userdata('level') == "guru"):
  echo "<div class='callout callout-warning'>Guru Hanya Dapat Akses Permasing-masing Kelas Ajar : ) </div>";


       if($kelas->num_rows() == NULL ):
        
        echo "<div class='callout callout-info'>Maaf Untuk Saat Ini Anda Belum Terdaftar untuk mengisikan nilai silahkan hubungi
            operator.</div>";
       endif;
 
 ?>	
   
   
<?php else: ?>
<?php endif; ?> 
<form action="" method="POST"> 
<table class="table table-striped">
<tr><td>Pilih Kelas</td><td>
		

<?php if($this->session->userdata('level') != "guru"): ?>		
<select class="form-control" name="kelas" required="">
	<option value="">--Pilih Kelas--</option>
	<?php

	 $no=1;foreach($kelas->result_array() as $hasil): ?>
	<option value="<?= $hasil['id_kelas'] ?>">
	<?= $hasil['ket']; ?> <b>(<?= $hasil['nama_kelas']; ?>)</b>
	</option>
<?php $no++;endforeach; ?>
</select>
<?php else: ?>

<select class="form-control" name="kelas" required="">
	<option value="">--Pilih Kelas--</option>
	<?php

	 $no=1;foreach($kelas->result_array() as $hasil): ?>
	<option value="<?= $hasil['id_kelas'] ?>">
	<?= $hasil['ket']; ?> <b>(<?= $hasil['nama_kelas']; ?>)</b>
	</option>
<?php $no++;endforeach; ?>
</select>

<?php endif; ?>

<tr><td>Semester</td><td>
	<select class="form-control" required="" name="semester"> 
	<option value="1">Satu / Ganjil</option>
	<option value="2">Dua / Genap</option>
</select></td></tr>


		
</td></tr>			 
		<tr><td><button type="submit" class="btn btn-primary" name="kirim">
					<i class="glyphicon glyphicon-floppy-disk"></i> Cari Data 
				</button>
				<a class="btn btn-warning" href="#">
					<i class="glyphicon glyphicon-arrow-left"></i> Batal 
				</a></td><td></td></tr>
		 
</table>
</form>