<?php 
 
class M_admin extends CI_Model
{
 

public function sudah()
 {
  return $this->db->query("SELECT * from siswa a, nilai b where a.id_siswa=b.id_siswa
        group by b.id_siswa");
 }


public function mapel_guru($id_kelas,$semester='')
{ 
return $this->db->query("SELECT * from guru a,mata_pelajaran b, kelas d
where b.id_kelas='$id_kelas' AND b.semester='$semester' AND (a.id_guru=b.id_guru) and (d.id_kelas=b.id_kelas)
group by b.id_mata_pelajaran");

}

public function mapel_guru_sess($id_guru,$id_kelas,$semester='')
{ 
return $this->db->query("SELECT * from guru a , mata_pelajaran b, kelas d
where a.id_guru='$id_guru' AND b.id_kelas='$id_kelas' AND b.semester='$semester' AND (a.id_guru=b.id_guru) and (d.id_kelas=b.id_kelas)
group by b.id_mata_pelajaran");

}


public function dapatkan_siswa($kelas,$semester)
{
 return $this->db->query("SELECT * from siswa  
                          where kelas='$kelas' AND semester='$semester'");
}

public function siswa($value='')
{
return $this->db->query("SELECT * from siswa a ,kelas b where (a.kelas=b.id_kelas) group by a.id_siswa") ; 
}

public function nilai($id_kelas,$semester)
{
return $this->db->query("
SELECT * from 
nilai a ,kelas b,siswa c
WHERE (a.id_kelas='$id_kelas')
AND (a.semester='$semester')
AND (a.id_kelas=b.id_kelas) 
AND (a.id_siswa=c.id_siswa)
 ");
}

public function nilai_sess($id_guru,$id_kelas,$semester)
{
return $this->db->query("
SELECT * from guru d,
nilai a ,kelas b,siswa c
WHERE (a.id_kelas='$id_kelas') 
AND (d.id_guru='$id_guru')
AND (d.id_guru=a.id_guru)
AND (a.semester='$semester')
AND (a.id_kelas=b.id_kelas) 
AND (a.id_siswa=c.id_siswa)
 ");

}

public function mapel()
{ 
return $this->db->query("SELECT * from guru a , mata_pelajaran b,  kelas d
where (b.id_guru=a.id_guru)  and (d.id_kelas=b.id_kelas)
group by b.id_mata_pelajaran");
}

public function siswa_data()
{
return $this->db->query("SELECT * from siswa a,kelas b where(a.kelas=b.id_kelas) GROUP BY a.id_siswa");
}


public function cari_siswa($kelas='',$semester='')
{
return $this->db->query("
SELECT * from 
nilai a,kelas b,siswa c 
where (a.id_kelas='$kelas')
AND   (a.semester='$semester')
AND   (a.id_siswa=c.id_siswa)
 group by a.id_siswa
 
  ");
}

public function data_siswa_nilai($kelas='',$semester='')
{
return $this->db->query("
SELECT * from kelas b,siswa c 
where (c.kelas='$kelas')
AND   (c.semester='$semester')
AND   (b.id_kelas=c.kelas)
 group by c.id_siswa
 
  ");
}


public function raport($id_siswa,$semester)
{
return $this->db->query("
SELECT * from 
nilai a ,kelas b,siswa c,mata_pelajaran d
WHERE (a.id_siswa='$id_siswa')
AND (a.semester='$semester')  
AND (a.id_kelas=b.id_kelas) 
AND (a.id_mata_pelajaran=d.id_mata_pelajaran) 
AND (a.id_siswa=c.id_siswa) group by a.id_nilai");
}


public function rank()
{
 
}
 


public function penilaian_set($id,$semester)
{
  return $this->db->query("SELECT * from mata_pelajaran where id_mata_pelajaran='$id' AND semester='$semester'");

}

public function cek_data_nilai($id,$semester)
{
  return $this->db->query("SELECT * from nilai where id_mata_pelajaran='$id' AND semester='$semester' GROUP BY id_mata_pelajaran");

}

public function cek_penilaian($id_siswa,$id,$semester)
{ 
 return $this->db->query("SELECT * from nilai where id_siswa='$id_siswa' AND id_mata_pelajaran='$id' AND semester='$semester'");
}


public function rekap($kelas,$semester)
{
 return $this->db->query("SELECT * from  mata_pelajaran a,kelas b, guru c
 	                      where a.id_kelas=b.id_kelas AND b.id_kelas='$kelas' AND a.semester='$semester' AND c.id_guru=a.id_guru  
 	                      GROUP BY a.id_mata_pelajaran");
}

public function kelas($id)
{
 return $this->db->query("SELECT * from  guru a,kelas b,mata_pelajaran c where a.id_guru=c.id_guru AND c.id_guru='$id' AND b.id_kelas=c.id_kelas group by c.id_kelas");
}

public function cari_data_siswa($semester,$mapel)
{ 
 return $this->db->query("SELECT * from nilai where semester='$semester' and id_mata_pelajaran != '$mapel'");
}


public function siswa_set_nilai($id)
{
 return $this->db->query("SELECT * from siswa where id_siswa !='$id'");
}

public function nip_guru()
{ 
 return $this->db->query("SELECT max(nip) as np from guru");

}

public function cek_siswa($semester,$id_kelas)
{
 return $this->db->query("
SELECT * from mata_pelajaran  
WHERE (semester='$semester')  
AND (id_kelas='$id_kelas')");
}

public function hasil_rekap($id)
{
 return $this->db->query("SELECT * from mata_pelajaran  
 	                      where id_mata_pelajaran= '$id'");

}


public function cetak_rekap_data_nilai($id)
{
 return $this->db->query("SELECT * from nilai a, mata_pelajaran b,kelas c,siswa d, guru e
 	                      where a.id_nilai= '$id' AND a.id_kelas=c.id_kelas AND a.semester=b.semester AND a.id_guru=e.id_guru AND a.id_siswa=d.id_siswa
 	                      GROUP BY a.id_mata_pelajaran");

}

public function raport_kelas_guru($id_guru)
{
 return $this->db->query("SELECT * from nilai a,guru b,kelas c 
       where a.id_guru='$id_guru' AND a.id_guru=b.id_guru AND a.id_kelas=c.id_kelas
 	  GROUP BY c.id_kelas");
}


public function rekap_akadedmik($id_mata_pelajaran)
{
 return $this->db->query("SELECT * from nilai a,guru b,kelas c,mata_pelajaran d 
       where a.id_mata_pelajaran='$id_mata_pelajaran' AND a.id_mata_pelajaran=d.id_mata_pelajaran AND a.id_guru=b.id_guru AND a.id_kelas=c.id_kelas
 	  GROUP BY a.id_nilai");

}

}