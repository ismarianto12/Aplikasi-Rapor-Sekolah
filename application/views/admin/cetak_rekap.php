 
 <style type="text/css">
 
 body{
  margin: 12px 70px 10px;   
 }
 hr{
  border-top: 1px solid #000; 
 }

.table td, .table th {    
    border: 1px solid #000;
    text-align: left;
    font-size: 12px;
    padding: 5px 10px 10px;
    
}

.table {
    border-collapse: collapse;
    width: 100%;
    margin: 30px 80px 10px;
}

.table th {
  background: #ddd;
  text-align: center;
}    
 
</style>

 <div style="margin-left:10px;left:-10px;text-align: center;">
<h4><?= cari('nama_sekolah') ?><br /> REKAPITULASI NILAI SISWA </h4>
<i><?= cari('alamat_sekolah') ?> | Telp : <?= cari('telp') ?> | No. SK <?= cari('sk_pendirian') ?></i> 
<hr />
</div>

<table class="table table-striped">
    <tr><th>Kelas</th><th><i><?= $data->row()->nama_kelas ?> / <?= $data->row()->ket ?></i></th></tr>
    <tr><th>Nama Mata Pelajaran</th><th><div class="callout callout-warning"><?= $data->row()->i_mata_pelajaran ?></div></th></tr>
    <tr><th>Guru Pengampu/Diajarkan Oleh</th><th><?= $data->row()->nama ?></th></tr>
    <tr><th>Semester</th><th><?= $data->row()->semester ?></th></tr>
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
            <td><a href="<?= base_url('admin/cetak_rekap_data_nilai/'.$sql['id_nilai']) ?>" class="btn btn-success"><i class="fa fa-print"></i></a> </td>
          </tr>
           <?php $no++; endforeach; ?>

                </tbody>
                </table>


<?php
require_once(APPPATH.'/third_party/html2pdf/html2pdf.class.php');
$content = ob_get_clean();
$html2pdf = new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);
$html2pdf->Output('Data Lapor Siswa.pdf');
?>
