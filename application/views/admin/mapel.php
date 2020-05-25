<a href="<?= base_url('admin/mapel_tambah') ?>" class="btn btn-primary">
<i class="fa fa-plus"></i>
Tambah Data</a>
<br /><br />
<?= $this->session->flashdata('pesan') ?>
<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Mata Pelajran</th>
                    <th>Kelas</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>Guru Pengampu</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
            <?php $no=1;foreach($data as $hasil): 
            if($hasil['semester'] == "1"):
            $semester="Semester  Satu";
            elseif ($hasil['semester'] == "2"): 
            $semester="Semester  Dua";
            endif;?>
            <tr>
            <td><?= $no; ?></td>
            <td><?= $hasil['kode']; ?></td>
            <td><?= $hasil['ket']; ?> <b>(<?= $hasil['nama_kelas']; ?>)</b></td>
            <td><?= $hasil['nama_mapel'] ?></td>
            <td><?= $hasil['nama'] ?></td>
            <td><?= $semester ?></td>
 
            <td><a href="<?= base_url('admin/mapel_edit/'.$hasil['id_mata_pelajaran']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>&nbsp;
            <a href="<?= base_url('admin/mapel_hapus/'.$hasil['id_mata_pelajaran']) ?>" class="btn btn-danger" onclick="alert('ANDA YAKIN AKAN MENGAHPUS DATA INI ?')"><i class="fa fa-trash"></i>Hapus</a></td>
            </tr>

           <?php $no++; endforeach; ?>


                </tbody>
                </table>
 
 
 