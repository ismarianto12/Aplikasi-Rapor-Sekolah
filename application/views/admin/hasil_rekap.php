<table class="table table-striped">
    <tr><th>Kelas</th><th><i><?= $data->row()->nama_kelas ?> / <?= $data->row()->ket ?></i></th>
    <tr><th>Nama Mata Pelajaran</th><th><div class="callout callout-warning"><?= $pelajaran->row()->nama_mapel ?></div></th><tr>
    <tr><th>Guru Pengampu/Diajarkan Oleh</th><th><?= $data->row()->nama ?></th><tr>
    <tr><th>Semester</th><th><?= $pelajaran->row()->semester ?></th><tr>
</table>
<hr />
<?= $this->session->flashdata('pesan') ?>
<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Siswa</th>
                    <th>Hasil Nilai</th>
                    <th>Nilai Ujian</th>
                    <th>Nilai Tugas</th>
                    <th>Nilai Ulangan</th>
                    <th>KKM (Krikteria Ketuntasan Minimal)</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
            <?php $no=1;foreach($data->result_array() as $sql):
                  $siswa=$this->db->get_where('siswa',array('id_siswa'=>$sql['id_siswa'])) ?>
            <tr>
            <td><?= $no; ?></td>
            <td><?= strip_tags($siswa->row()->nama_s); ?></td>
            <td><?= $sql['ket_nilai'] ?></td>
            <td><?= $sql['nj']; ?></td>
            <td><?= $sql['nt'] ?></td>
            <td><?= $sql['nu'] ?></td>
            <td><?= $sql['kkm'] ?></td>
            <td><a href="<?= base_url('admin/cetak_rekap_data_nilai/'.$sql['id_nilai']) ?>" class="btn btn-success"><i class="fa fa-print"></i> </td>
           <?php $no++; endforeach; ?>

                </tbody>
                </table>