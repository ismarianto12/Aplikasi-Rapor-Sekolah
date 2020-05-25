<?= $this->session->flashdata('pesan') ?>
<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nilai</th>
                    <th>Keterangan</th>
                    <th>Nama Siswa</th>
                    <th>Nama Mata pelajaran</th>
                    <th>Kelas</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
            <?php $no=1;foreach($data as $hasil): 
                       $mapel=$this->db->get_where('mata_pelajaran',array('id_mata_pelajaran'=>$hasil['id_mata_pelajaran']));
                if($hasil['semester'] == "1"):
                $semester="Semester Ganjil Satu";
                elseif ($hasil['semester'] == "2"): 
                $semester="Semester Genap Dua";
                endif;

              ?>
            <tr>
            <td><?= $no; ?></td>
            <td><?= $hasil['nilai']; ?></td>
            <td><?= $hasil['ket_nilai']; ?></td>
            <td><?= $hasil['nama_s']; ?></td> 
            <td><?= '<b>('.$hasil['nama_kelas'].'/'.$hasil['ket'].')</b>'; ?></td>  
            <td><?= $mapel->row()->nama_mapel; ?></td>    
            <td><?= $semester; ?></td>            
            <td><a href="<?= base_url('admin/nilai_edit/'.$hasil['id_nilai']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i>Edit Nilai</a>&nbsp;
            <a href="<?= base_url('admin/nilai_hapus/'.$hasil['id_nilai']) ?>" class="btn btn-danger" onclick="alert('ANDA YAKIN AKAN MENGAHPUS DATA INI ?')"><i class="fa fa-trash"></i>Hapus Data Nilai</a></td>
            </tr>

           <?php $no++; endforeach; ?>
                </tbody>
                </table>


<a href="#" onclick="window.print()" class="btn btn-primary">Print This Page</a> 
 
