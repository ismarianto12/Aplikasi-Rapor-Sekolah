 
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
  <h3><?= cari('nama_sekolah') ?> <br />
 LAPORAN PENILAIAN HASIL BELAJAR SISWA</h3>
<i><?= cari('alamat_sekolah') ?> | Telp : <?= cari('telp') ?> | No. SK <?= cari('sk_pendirian') ?></i> 
<hr />
</div>

<table style="height: 73px;" width="384">
<tbody>
<tr>
<td style="width: 184px;">Nama Peserta Didik</td>
<td style="width: 184px;">: <b><?= $nama ?></b></td>
</tr>
<tr>
<td style="width: 184px;">Nomor Induk</td>
<td style="width: 184px;">: <b><?= $nisn ?></b></td>
</tr>
<tr>
<td style="width: 184px;">Kelas</td>
<td style="width: 184px;">: <b><?= $ket ?>/<?= $nama_kelas ?></b></td>
</tr>
<tr>
<td style="width: 184px;">Nama Sekolah</td>
<td colspan="4">: <?= cari('nama_sekolah') ?></td>
</tr>
</tbody>
</table>
 


<table class="table">
<tbody>
<tr>
<td><strong>No</strong></td>
<td><strong>Komponen/Mata Pelajaran</strong></td>
<td><strong>Krikteria Ketuntasan Minimal</strong></td>
<td><strong>Niliai</strong></td>
<td><strong>Hasil Studi</strong></td>
</tr>
<?php 
$sum='';
$rata1 = $data->num_rows(); 
$hasil_rata='';
$no=1;foreach($data->result_array() as $hasil):
$guru=$this->db->get_where('guru',array('id_guru'=>$hasil['id_guru']));   

 ?>
<tr>
<td><?= $no ?></td>
<td><?= $hasil['nama_mapel'] ?></td>
<td><?= $hasil['kkm'] ?></td>
<td><?= $hasil['nilai'] ?></td>
<td><?= $hasil['ket_nilai'] ?></td>
</tr>
<?php
 $sum += $hasil['nilai'];
 $no++; endforeach; ?>
</tbody>
</table>
 



<table class="table">
<tbody>
<tr>
<td style="width: 126px;"><strong>JUMLAH</strong></td>
<td style="width: 126px;"><?= $sum ?></td>
 
</tr>
<tr>
<td style="width: 126px;"><strong>RATA-RATA</strong></td>
<td style="width: 126px;"><?php 
$hasil_rata=$sum/$rata1;
echo $hasil_rata; ?></td>
 
</tr>
<tr>
 
</tr>
</tbody>
</table>
<p></p>
<p>Wali Kelas <br /><br />
	<b><?= $guru->row()->nama ?></b>
<hr />
NIP : <?= $guru->row()->nip ?></p>


<small><i>Dicetak Pada Tanggal <?= tgl_indonesia(date('Y-m-d')) ?> Jam <?= date('h:i:s') ?></i></small>
 


	<?php
require_once(APPPATH.'/third_party/html2pdf/html2pdf.class.php');
$content = ob_get_clean();
$html2pdf = new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);
$html2pdf->Output('Data Lapor Siswa.pdf');
?>
