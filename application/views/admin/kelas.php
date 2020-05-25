<a href="<?= base_url('admin/kelas_tambah') ?>" class="btn btn-primary">
<i class="fa fa-plus"></i>
Tambah Data</a>
<br /><br />
<?= $this->session->flashdata('pesan') ?>
<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Dengan Huruf</th>
                    <th>Lokal Dengan Angka</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
            <?php $no=1;foreach($data as $hasil): ?>
            <tr>
            <td><?= $no; ?></td>
            <td><?= $hasil['nama_kelas']; ?></td>
            <td><?= $hasil['ket']; ?></td>          
            <td><a href="<?= base_url('admin/kelas_edit/'.$hasil['id_kelas']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>&nbsp;
            <a href="<?= base_url('admin/kelas_hapus/'.$hasil['id_kelas']) ?>" class="btn btn-danger" onclick="alert('ANDA YAKIN AKAN MENGAHPUS DATA INI ?')"><i class="fa fa-trash"></i>Hapus</a></td>
            </tr>

           <?php $no++; endforeach; ?>


                </tbody>
                </table>
 