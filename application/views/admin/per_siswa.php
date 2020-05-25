<?php
 if($this->session->userdata('level') =="guru"):
     if ($kelas->num_rows() == NULL) {
         $x['judul'] ="Kesalahan ";
          
         include (APPPATH.'/views/header.php');
         echo "<div class='callout callout-danger'>Maaf Untuk Saat Ini Modul Lapor Data Belum Bisa Diakses Pastikan Anda Mengisi Data Nilai Akademik .</div>";
         include (APPPATH.'/views/footer.php');
         exit();
         $this->db->close();
     }else{
     }

   else:
   endif; 

?>
<form action="" method="POST"> 
<table class="table table-striped">
<tr><td>Pilih Kelas</td><td>
        
<select class="form-control" name="kelas" required="">
    <option value="">--Pilih Kelas--</option>
    <?php

     $no=1;foreach($kelas->result_array() as $hasil): ?>
    <option value="<?= $hasil['id_kelas'] ?>">
    <?= $hasil['ket']; ?> <b>(<?= $hasil['nama_kelas']; ?>)</b>
    </option>
<?php $no++;endforeach; ?>
</select>
</td></tr>   

<tr><td>Pilih Semester</td><td>
        
<select class="form-control" name="semester" required="">
    <option value="1">Semester Ganjil / Satu</option>
    <option value="2">Semester Genap / Dua</option>
</select>
</td></tr>           
        <tr><td><button type="submit" class="btn btn-primary" name="kirim">
                    <i class="glyphicon glyphicon-search"></i> Cari 
                </button>
                <a class="btn btn-warning" href="#">
                    <i class="glyphicon glyphicon-arrow-left"></i> Batal 
                </a></td><td></td></tr>
         
</table>
</form>


<?php
 

if(isset($_POST['kirim'])): ?>
<?= $this->session->flashdata('pesan') ?>
 
<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nama Orang Tua</th>
                    <th>Foto</th>
                    <th>NISN</th>
                    <th>Jenis Kelamin</th>
                    <th>Semester</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
 
                </tr>
                </thead>
                <tbody>
            <?php $no=1;foreach($data as $hasil):
            if($hasil['jk']== "L"):
            $jk="Laki-Laki";
            else:
            $jk="Perempuan";    
            endif;
            if($hasil['semester'] == "1"):
                $semester="Semester Ganjil Satu";
                elseif ($hasil['semester'] == "2"): 
                $semester="Semester Genap Dua";
            endif;


             ?>
            <tr>
            <td><?= $no; ?></td>
            <td><?= $hasil['nama_s']; ?></td>
            <td><?= $hasil['nama_orang_tua']; ?></td>
            <td><img src="<?= base_url('assets/file/'.$hasil['foto']) ?>" class="img-responsive" style="width:100px;height: 100px"></td>
            <td><?= $hasil['nisn']; ?></td>
            <td><?= $jk ?></td>
             <td><?= $semester ?></td>
            <td><?= $hasil['nama_kelas'].''.$hasil['ket'] ?></td> 
            <td><a href="<?= base_url('cetak/raport/'.$hasil['id_siswa'].'/'.$this->input->post('semester').'/'.'-Data-Nilai-Raport-Cetak') ?>" class="btn btn-primary"><i class="fa fa-print"></i>Cetak Nilai Raport</a>&nbsp;
            </td>
            </tr>

           <?php $no++; endforeach; ?>


                </tbody>
                </table>

<?php else: endif; ?>
 
 
 
 