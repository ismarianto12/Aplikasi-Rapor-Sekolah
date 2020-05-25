<?php if($depan == FALSE ): ?>
<a href="<?= base_url('admin/siswa_tambah') ?>" class="btn btn-primary">
<i class="fa fa-plus"></i>
Tambah Data</a>
<br /><br />
  <?php else: endif; ?>
<?= $this->session->flashdata('pesan'); ?>
<hr />
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
                    <?php if($depan == FALSE ): ?>
                    <th>Aksi</th>
                     <?php else: endif; ?>
                </tr>
                </thead>
                <tbody>
            <?php $no=1; foreach($data as $hasil):
            if($hasil['semester'] == "1"):
             $semester="Semester Ganjil Satu";
            elseif ($hasil['semester'] == "2"): 
             $semester="Semester Genap Dua";
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
            <th><?= $semester ?></th>
            <?php if($depan == FALSE ): ?>
            <td><a href="<?= base_url('admin/siswa_edit/'.$hasil['id_siswa']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>&nbsp;
            <a href="<?= base_url('admin/siswa_hapus/'.$hasil['id_siswa']) ?>" class="btn btn-danger" onclick="alert('ANDA YAKIN AKAN MENGAHPUS DATA INI ?')"><i class="fa fa-trash"></i>Hapus</a></td>
           <?php else: endif; ?>
 
            </tr>

           <?php $no++; endforeach; ?>


                </tbody>
                </table>
 
 
 
 