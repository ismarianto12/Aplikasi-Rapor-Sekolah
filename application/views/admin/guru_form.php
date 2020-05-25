<form action="" method="POST" enctype="multipart/form-data"> 
<table class="table table-striped">
		<tr><td>Nama</td><td><input type="text" name="nama" class="form-control" value="<?= $nama ?>" required=""></td></tr>

		<tr><td>Username</td><td><input type="text" name="username" class="form-control" value="<?= $username ?>" required=""></td></tr>
		<tr><td>Password</td><td><input type="text" name="password" class="form-control" value="" required=""></td></tr>

		<tr><td>Email</td><td><input type="email" name="email" class="form-control" value="<?= $email ?>" required=""></td></tr>

		<tr><td>Nip</td><td>
<?php if($aksi =="edit"): ?>
	<div class="callout callout-warning">Untuk Saat Ini Nip Tidak Bisa Di Edit.</div>
<?php else: ?>
			<input type="text" name="nip" class="form-control"  value="<?= $nip ?>" required="">
		<?php endif; ?>
			<tr><td>Jenis Kelamin</td><td><select class="form-control" required="" name="jenis_kelamin"> 
			<option value="L">Laki-Laki</option>
			<option value="L">Perempuan</option>
		</select></td></tr>

      <?php
        if($aksi=="edit"){
          echo "<img src='".base_url('/assets/file/'.$gambar)."' class='img-responsive' style='width:100px'>";
        }else{

        }
    

       ?>
		<tr><td>Foto</td><td><input type="file" name="foto" class="form-control"  value="" required=""></td></tr>

		<tr><td><button type="submit" class="btn btn-primary" name="kirim">
					<i class="glyphicon glyphicon-floppy-disk"></i> Simpan 
				</button>
				<a class="btn btn-warning" href="#">
					<i class="glyphicon glyphicon-arrow-left"></i> Batal 
				</a></td><td></td></tr>
		 
</table>
</form>

 
