<?php if($form == 'n'):  ?>
 
<?= $this->session->flashdata('pesan') ?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
	<tr>
	 
		<th>Nama Pengaturan</th>
		<th>Nilai </th>
		<th>Aksi</th>
	</tr>
	</thead>
<tbody>
	<?php $no=1; foreach($data->result() as $data): ?>
 <tr>
 
    <td><?= $data->parameter ?></td>
    <td>

<?php if($data->parameter == 'favicon' OR  $data->parameter == 'gambar'): ?>
 <img src="<?= base_url('assets/home/'.$data->nilai) ?>" class="img-responsive" style="width: 100px;height: 100px">
<?php else:  ?>
    	<?= $data->nilai ?>
    		<?php endif; ?>
    	</td>
    <td><a href="<?= base_url('admin/setting/edit/'.$data->parameter) ?>" class="btn btn-info"><i class="fa fa-edit"></i>Edit</a>
        </td>
 </tr>
   <?php $no++; endforeach; ?>
</tbody>

</table>

<?php elseif($form =='y'): 
?>


<form action="" method="POST" enctype="multipart/form-data"> 
<table class="table table-striped">
		<tr><td>Parameter</td><td><input type="text" name="nama" class="form-control" value="<?= $data->row()->parameter ?>" required=""></td></tr>
		<tr><td>Nilai Setting</td><td> 

<?php if($id == 'favicon' ||  $id == 'gambar'): ?>
 <img src="<?= base_url('assets/home/'.$data->row()->nilai) ?>" class="img-responsive">
 <input type="file" name="<?= strip_tags($id) ?>" class="form-control">
<?php elseif($id == 'misi_visi'):  ?>
  
<textarea cols="100" rows="10" class="ckeditor form-control" name="nilai"><?= strip_tags($data->row()->nilai) ?></textarea>

<?php else: ?>
<input type="text" name="nilai" class="form-control" value="<?= strip_tags($data->row()->nilai) ?>">
<?php endif; ?>
		</td></tr>

		<tr><td><button type="submit" class="btn btn-primary" name="kirim">
					<i class="glyphicon glyphicon-floppy-disk"></i> Simpan 
				</button>
				<a class="btn btn-warning" href="#">
					<i class="glyphicon glyphicon-arrow-left"></i> Batal 
				</a></td><td></td></tr>
		 
</table>
</form>

 


<?php

endif;
?>