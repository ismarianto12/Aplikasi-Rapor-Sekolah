<a href="<?= base_url('admin/user_tambah') ?>" class="btn btn-primary">
<i class="fa fa-plus"></i>
Tambah Data</a>
<br /><br />
<?= $this->session->flashdata('pesan') ?>
<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
 
                   <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Password</th>
                    <th>Level Akses</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
            <?php $no=1;foreach($user as $hasil): ?>
            <tr>
            <td><?= $no; ?></td>
                <td><?= $hasil['username']; ?></td>
                <td><?= $hasil['nama']; ?></td>
                <td><?= $hasil['password']; ?></td>
                <td><?= $hasil['level']; ?></td>
                <td><a href="<?= base_url('admin/edit_user/'.$hasil['id_admin']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>&nbsp;
                    <a href="<?= base_url('admin/hapus_user/'.$hasil['id_admin']) ?>" class="btn btn-danger" onclick="alert('ANDA YAKIN AKAN MENGAHPUS DATA INI ?')"><i class="fa fa-trash"></i>Hapus</a></td>
            </tr>

           <?php $no++; endforeach; ?>


                </tbody>
                </table>
 