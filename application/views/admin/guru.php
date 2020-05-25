<?= $this->session->flashdata('pesan') ?>
<div class="clearfix"></div>
<?php if($depan == FALSE ): ?>
<a href="<?= base_url('admin/guru_tambah') ?>" class="btn btn-primary">
<i class="fa fa-plus"></i>
Tambah Data</a>
<br /><br />
 
<?php else: endif; ?>

<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Foto</th>
                    <th>Nip</th>
                    <th>Usernmame</th>
                    <th>Password</th>
                    <th>Jenis Kelamin</th>
                    <?php if($depan == FALSE ): ?>
                    <th>Aksi</th>
                    <?php else: endif; ?>
                </tr>
                </thead>
                <tbody>
            <?php $no=1;foreach($data as $hasil): 
                   $jk=($hasil['jenis_kelamin'] == "L") ? "Laki -laki" : "Perempuan";
               ?>
            <tr>
            <td><?= $no; ?></td>
            <td><?= $hasil['nama']; ?></td>
            <td><img src="<?= base_url('assets/file/'.$hasil['foto']) ?>" class="img-responsive" style="width:100px;height: 100px"></td>
            <td><?= $hasil['nip']; ?></td>
            <td><?= $hasil['username']; ?></td>
            <td><?= $hasil['r_pass']; ?></td>
            <td><?= $jk ?></td>

           <?php if($depan == FALSE ): ?>
            <td><a href="<?= base_url('admin/guru_edit/'.$hasil['id_guru']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>&nbsp;
            <a href="<?= base_url('admin/guru_hapus/'.$hasil['id_guru']) ?>" class="btn btn-danger" onclick="alert('ANDA YAKIN AKAN MENGAHPUS DATA INI ?')"><i class="fa fa-trash"></i>Hapus</a></td>
             <?php else: endif; ?>  
            </tr>

           <?php $no++; endforeach; ?>


                </tbody>
                </table>
 
 
 