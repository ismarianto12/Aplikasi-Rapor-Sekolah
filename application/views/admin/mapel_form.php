<form action="" method="POST"> 
<table class="table table-striped">
		<tr><td>Kode Mata Pelajaran</td><td><input type="text" name="kode" class="form-control" value="<?= $kode ?>" required=""></td></tr>
		<tr><td>Nama Mata Pelajaran</td><td><input type="text" name="nama_mapel" class="form-control"  value="<?= $nama_mapel ?>" required=""></td></tr>
		
			<tr><td>Guru Pengampu Mapel</td><td><select class="form-control" required="" name="id_guru">
			 <?php $no=1; foreach($guru as $data_guru): $no++; ?>
			 <option value="<?= $data_guru['id_guru'] ?>"><?= $data_guru['nama'] ?></option>
			 <?php endforeach; ?> 
		</select></td></tr>

		
   	<tr><td>Semester</td><td>
       	<select class="form-control" required="" name="semester"> 
			<option value="1">Satu / Ganjil</option>
			<option value="2">Dua / Genap</option>
		</select></td></tr>

		<tr><td>Kelas</td><td><select class="form-control" name="kelas">
			<?php $no=1; foreach($kelas as $kelas_): $no++; ?>
			<option value="<?= $kelas_['id_kelas'] ?>"><?= $kelas_['ket'] ?> <b>(<?= $kelas_['nama_kelas'] ?>)</b></option>
			<?php endforeach; ?> 
		</select></td></tr>
        
        <tr><td>Tahun Akademik </td><td><input type="number" name="ta_akademik" class="form-control" required="" value="<?= $ta_akademik ?>"></td></tr>
		 
		<tr><td><button type="submit" class="btn btn-primary" name="kirim">
					<i class="glyphicon glyphicon-floppy-disk"></i> Simpan 
				</button>
				<a class="btn btn-warning" href="#">
					<i class="glyphicon glyphicon-arrow-left"></i> Batal 
				</a></td><td></td></tr>
		 
</table>
</form>

 