<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function buat_menu($session,$judul,$level,$url,$font='fa fa-circle-o'){
	if($session == $level ){
     echo '<li><a href="'.$url.'"><i class="'.$font.' text-aqua"></i> <span>'.$judul.'</span></a></li>';
	}else{
		
	}

}

function cari($data)
{
 $CI =& get_instance();
 $sql=$CI->db->get_where("setting",array('parameter'=>$data));
 return $sql->row()->nilai;
}

 
function tutup_form_login($link,$name){
	echo'<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary" name="'.$name.'">
					<i class="glyphicon glyphicon-floppy-disk"></i> Login 
				</button>
				<a class="btn btn-warning" href="'.$link.'">
					<i class="glyphicon glyphicon-arrow-left"></i> Batal 
				</a>
			</div>
		</div>
	</form>';
}
 

 function aman($nilai='')
{
 return mysql_real_escape_string($nilai);
}

function buka_dropdown($session='',$judul='',$level='',$url='',$awesome=''){
		if($session == $level ){
		echo '
		<li class="treeview">
		<a href="'.$url.'">
		<i class="fa fa-'.$awesome.'"></i> <span>'.$judul.'</span>
		<span class="pull-right-container">
		<i class="fa fa-angle-left pull-right"></i>
		</span>
		</a>
		<ul class="treeview-menu" style="display: none;">';
		}else{

		}
	}

function tutup_dropdown(){
 echo ' </ul>
      </li>';
}

function barasiah($string)
{
 return mysql_real_escape_string($string);
}




function tgl_indonesia($tgl){
	$nama_bulan = array(1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		
	$tanggal = substr($tgl,8,2);
	$bulan = $nama_bulan[(int)substr($tgl,5,2)];
	$tahun = substr($tgl,0,4);
	
	return $tanggal.' '.$bulan.' '.$tahun;		 
}	

function buka_form($link, $id, $aksi){
	echo'<form method="post" action="'.$link.'" class="form-horizontal" enctype="multipart/form-data">
			<input type="hidden" name="id" value="'.$id.'">
			<input type="hidden" name="aksi" value="'.$aksi.'">';
}

function buat_textbox($label, $nama, $nilai, $lebar='4', $tipe="text",$required=''){
	echo'<div class="form-group" id="'.$nama.'">
			<label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
			<div class="col-sm-'.$lebar.'">
			  <input type="'.$tipe.'" class="form-control" name="'.$nama.'" value="'.$nilai.'" '.$required.'>
			</div>
		 </div>';
}

function buat_textarea($label, $nama, $nilai, $class=''){
	echo'<div class="form-group" id="'.$nama.'">
			<label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
			<div class="col-sm-10">
			  <textarea class="form-control ckeditor" rows="8" name="'.$nama.'">'.$nilai.'</textarea>
			</div>
		 </div>';
}

function buat_combobox($label, $nama, $list, $nilai, $lebar='4'){
	echo'<div class="form-group" id="'.$nama.'">
			<label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
			<div class="col-sm-'.$lebar.'">
			  <select class="form-control" name="'.$nama.'">';
		foreach($list as $ls){
			$select = $ls['val']==$nilai ? 'selected' : '';
			echo'<option value='.$ls['val'].' '.$select.'>'.$ls['cap'].'</option>';
		}
	echo'	  </select>
			</div>
		 </div>';
}

function buat_checkbox($label, $nama, $list){
	echo'<div class="form-group" id="'.$nama.'">
			<label class="col-sm-2 control-label">'.$label.'</label>
			<div class="col-sm-10">';
		foreach($list as $ls){
			echo' <input type="checkbox" name="'.$nama.'[]" value="'.$ls['val'].'" '.$ls['check'].'> '.$ls['cap'];
		}
	echo'	</div>
		</div>';
}

function buat_radio($label, $nama, $list){
	echo'<div class="form-group" id="'.$nama.'">
			<label class="col-sm-2 control-label">'.$label.'</label>
			<div class="col-sm-10">';
		foreach($list as $ls){
			echo'<label  for="'.$nama.$ls['val'].'" id="label_'.$nama.$ls['val'].'"> 
					<input type="radio" name="'.$nama.'" id="'.$nama.$ls['val'].'" value="'.$ls['val'].'" '.$ls['check'].'> '.$ls['cap'].' 
				</label>';
		}
	echo'	</div>
		</div>';
}


	
function tutup_form($link,$name){
	echo'<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary" name="'.$name.'">
					<i class="glyphicon glyphicon-floppy-disk"></i> Simpan 
				</button>
				<a class="btn btn-warning" href="'.$link.'">
					<i class="glyphicon glyphicon-arrow-left"></i> Batal 
				</a>
			</div>
		</div>
	</form>';
}
 

function buat_alert($pesan){

echo'<script type="text/javascript">  swal({
  title: "Informasi",
  text: "'.$pesan.' Silahkan Refresh Browser Anda",
  icon: "info",
  button: "OK",
});</script>'; 
}



  function buka_modal($judul,$link)
{
 echo '<div class="modal fade" id="'.$link.'" tabindex="-1" role="dialog" aria-labelledby="'.$link.'Label" aria-hidden="true">
      <div class="modal-dialog" role="document" style="width: 100%"> 
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">'.$judul.'</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>';
        
}


function modal_isi($isi){
  echo '<div class="modal-body">'.$isi.'</div>';

}

  function tutup_modal()
{
	echo '<div class="modal-footer">   
          </div>
        </div>
      </div>
    </div>';
}


function buat_kotak($warna,$link,$judul){
echo '<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-'.$warna.'">
            <div class="inner">
              <p><b>'.$judul.'</b></p>
            </div>
            <div class="icon">
              <i class="fa fa-envelope"></i>
            </div>
            <a href="'.$link.'" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>';
}