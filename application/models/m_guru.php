<?php 

/**
* 
*/
class M_guru extends CI_model
{
	
 public function mata_pelajaran($id)
 {
  return $this->db->query("
 SELECT * from 
 nilai a,mata_pelajaran b ,siswa c ,semester d,kelas e,guru f 
 where (a.id_mata_pelajaran=b.id_mata_pelajaran) 
 AND (a.id_siswa=c.id_siswa) 
 AND (a.id_semester=d.id_semester)
 AND (a.id_guru='$id')
 group by a.id_nilai ");
 
 }


public function mapel_guru()
{ 
return $this->db->query("SELECT * from guru a , mata_pelajaran b, kelas d
where (b.id_guru=a.id_guru) and (d.id_kelas=b.id_kelas)
group by b.id_mata_pelajaran");

}

public function siswa_data($id='')
{
return $this->db->query("SELECT * from siswa a,kelas b where(a.kelas=b.id_kelas) GROUP BY a.id_siswa");
}


}