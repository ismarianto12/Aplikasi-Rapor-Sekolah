<form action="" method="POST" enctype="multipart/form-data"> 
<table class="table table-striped">
		<tr><td>Nama</td><td><input type="text" name="nama" class="form-control" value="<?= $nama ?>" required=""></td></tr>
		<tr><td>NISN</td><td><input type="number" name="nip" class="form-control"  value="<?= $nisn ?>" required=""></td></tr>
		
			<tr><td>Jenis Kelamin</td><td><select class="form-control" required="" name="jenis_kelamin"> 
			<option value="L">Laki-Laki</option>
			<option value="L">Perempuan</option>
		</select></td></tr>

       <tr><td>Nama Orang Tua</td><td><input type="text" name="nama_orang_tua" class="form-control"  value="<?= $nama_orang_tua ?>" required=""></td></tr>

      <?php
        if($aksi=="edit"){
          echo "<img src='".base_url('/assets/file/'.$gambar)."' class='img-responsive' style='width:100px'>";
        }else{

        }
    

       ?>

       	<tr><td>Kelas </td><td>
       	<select class="form-control" required="" name="kelas"> 
			<?php $no=1; foreach($kelas as $kelas_): $no++; ?>
			<option value="<?= $kelas_['id_kelas'] ?>"><?= $kelas_['nama_kelas'] ?>/<?= $kelas_['ket'] ?></option>
		   <?php endforeach; ?>
		</select></td></tr>



   	<tr><td>Semester</td><td>
       	<select class="form-control" required="" name="semester"> 
			<option value="1">Satu / Ganjil</option>
			<option value="2">Dua / Genap</option>
		</select></td></tr>


		<tr><td>Foto</td><td><input type="file" name="foto" class="form-control"  value="" required=""></td></tr>

		<tr><td><button type="submit" class="btn btn-primary" name="kirim">
					<i class="glyphicon glyphicon-floppy-disk"></i> Simpan 
				</button>
				<a class="btn btn-warning" href="#">
					<i class="glyphicon glyphicon-arrow-left"></i> Batal 
				</a></td><td></td></tr>
		 
</table>
</form>

 
 