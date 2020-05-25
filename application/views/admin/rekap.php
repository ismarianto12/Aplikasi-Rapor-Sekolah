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
                    <td>Aksi</td>
                </tr>
                </thead>
                <tbody>
            <?php $no=1;foreach($data->result_array() as $hasil): 
            if($hasil['semester'] == "1"):
            $semester="Semester Satu";
            elseif ($hasil['semester'] == "2"): 
            $semester="Semester Dua";
            endif;?>
            <tr>
            <td><?= $no; ?></td>
            <td><?= $hasil['kode']; ?></td>
            <td><?= $hasil['ket']; ?> <b>(<?= $hasil['nama_kelas']; ?>)</b></td>
            <td><?= $hasil['nama_mapel'] ?></td>
            <td><?= $hasil['nama'] ?></td>
            <td><?= $semester ?></td>
            <td><a href="<?= base_url('admin/rekap_data_nilai/'.$hasil['id_mata_pelajaran']) ?>" class="btn btn-info"><i class="fa fa-eye"></i></a> </td>
           <?php $no++; endforeach; ?>

                </tbody>
                </table>