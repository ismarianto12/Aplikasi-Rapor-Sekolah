
 
<?php 
echo $this->session->flashdata('pesan');
buka_form('','','');
buat_textbox('Username','username', $username,'4',"text","required");
buat_textbox('Nama','nama',$nama,'10', "text","required");
buat_textbox('Password','password', '','10', "password","required");

if($this->session->userdata('level') == "admin" OR $this->session->userdata('level') == "operator"): 
if($aksi == 'profil'):
else:
?>

<div class="form-group" id="password">
			<label for="password" class="col-sm-2 control-label">Level Akses</label>
			<div class="col-sm-8">
			  <select name="level" class="form-control" required>
				<option>--Level Akses--</option>
				<option value="admin">Administrator</option>
				<option value="operator">Operator Sekolah</option>
			  </select>
			</div>
		 </div>

<?php 
endif;
elseif($this->session->userdata('level') == "guru"):

else:
?>
<div class="form-group" id="password">
			<label for="password" class="col-sm-2 control-label">Level Akses</label>
			<div class="col-sm-8">
			  <select name="level" class="form-control" required>
				<option>--Level Akses--</option>
				<option value="admin">Administrator</option>
				<option value="operator">Operator Sekolah</option>
			  </select>
			</div>
		 </div>
<?php 
endif;	 
tutup_form('','kirim'); 




 