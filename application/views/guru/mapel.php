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
                    <th>Jumlah Siswa Yang Telah Di Dinilai</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
            <?php $no=1;foreach($data->result_array() as $hasil): 
                  $cek_jumlah=$this->db->get_where('nilai',array(
                     'id_siswa'=>$siswa->row()->id_siswa,
                     'id_mata_pelajaran'=>$hasil['id_mata_pelajaran']));
                  
                  $kelas=$this->db->get_where('kelas',array('id_kelas'=>$siswa->row()->kelas));
                  if($hasil['semester'] =="1"){
                     $semester="Satu (1)";
                  }elseif($hasil['semester'] =="2"){
                     $semester="Dua (2)";   
                  }else{
                      $semester="Sys Admin Log Error";
                  }

                   ?>
            <tr>
            <td><?= $no; ?></td>
            <td><?= $hasil['kode']; ?></td>
            <td><?= $hasil['ket']; ?> <b>(<?= $hasil['nama_kelas']; ?>)</b></td>
            <td><?= $hasil['nama_mapel'] ?></td>
            <td><?= $hasil['nama'] ?></td>
            <td><b><?= $semester ?></b></td>
            <td><?php 
                  $jumlah_cek=$cek_jumlah->num_rows();
                  $cek_semua =$jumlah_cek-$siswa->num_rows();
                  echo $jumlah_cek.' Orang ';
                  echo $siswa->num_rows();
             ?></td>
            <td>
              <?php if($cek_semua == '0'): ?>
                 <div class="callout callout-warning">Semua Data Nilai Pada Kelas <?= $kelas->row()->ket ?>/<?= $kelas->row()->nama_kelas ?> Dan Semester <?= $semester ?></div>
               <?php else: ?> 
              <a href="<?= base_url('admin/penilaian_set/'.$hasil['id_mata_pelajaran'].'/'.$hasil['semester']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i>Set Nilai Siswa</a>&nbsp;
            <?php endif; ?>
        </td>
     
            </tr>

           <?php $no++; endforeach; ?>


                </tbody>
                </table>
 
 