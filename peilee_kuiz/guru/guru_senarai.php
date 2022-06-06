<?PHP
# Memaggil fail header_guru.php
include('header_guru.php');

# Menyemak kewujudan data POST untuk proses mendaftar guru baru
if(!empty($_POST))
{
	# mengambil data dr form yg dimasukkan oleh admin
	$nama         = mysqli_real_escape_string($condb,$_POST['nama_baru']);
	$nokp         = mysqli_real_escape_string($condb,$_POST['nokp_baru']);
	$katalaluan   = mysqli_real_escape_string($condb,$_POST['katalaluan_baru']);
	$tahap        = $_POST['tahap']; 
	
	# menyemak kewujudan data yg diambil
	if(empty($nama) or empty($nokp) or empty($katalaluan) or empty($tahap))
	{
		# jika data tdk wujud aturcara akan terhenti disini
		die("<script>alert('Sila lengkapkan maklumat');
		window.history.back();</script>");
	}
	# had atas& bwh data validation bg nokp guru
	if(strlen($nokp)!=12 or !is_numeric($nokp))
	{
		die("<script>alert('Ralat No K/P');
		window.history.back();</script>");
	}
	# arahan utk menyimpan data guru
	$arahan_simpan="insert into guru
	(nama_guru,nokp_guru,katalaluan_guru,tahap)
	values
	('$nama','$nokp','$katalaluan','$tahap')";
	
	# melaksanakan arahan utk menyimpan data guru ke dlm jadual
	if(mysqli_query($condb,$arahan_simpan))
	{
		#data berjaya disimpan
		echo"<script>alert('Pendaftaran BERJAYA');
		window.location.href='guru_senarai.php';</script>";
	}
	else
	{
		#data gagal disimpan
		echo"<script>alert('Pendaftaran GAGAL');
		window.location.href='guru_senarai.php';</script>";
	}
}
?>

<!-- bahagian utk memaparkan senarai guru-->
<div class='w3-panel w3-hover-border-grey w3-leftbar w3-light-grey'>
<h3>Senarai Guru</h3>
</div>
<?PHP include('../butang_saiz.php'); ?>
<table border='1' id='besar' class='w3-table w3-hoverable w3-border-0 w3-margin-top w3-text-black w3-roboto'>

<div class='w3-responsive'>
    <tr class='w3-khaki'>
	    <td>Nama</td>
		<td>Nokp</td>
		<td>Password</td>
		<td>Tahap</td>
		<td>Tindakan</td>
	</tr>
	<tr>
    <!-- brg utk mendaftar guru baru -->
    <form action='' method='POST'>
	<td><input class="w3-input" type='text'       name='nama_baru'></td>
    <td><input class="w3-input" type='text'       name='nokp_baru'></td>
	<td><input class="w3-input" type='password'   name='katalaluan_baru'></td>
	<td>
	    <select class="w3-select" name='tahap'>
		    <option value  selected disabled>Pilih</option>
			<option value='GURU'>GURU</option>
			<option value='ADMIN'>ADMIN</option>
		</select>
		</td>
		<td><input class=' w3-button w3-khaki w3-round-xlarge w3-block' type='submit' value='Simpan'></td>
	</form>
	</tr>
	
<?PHP

#arahan sql utk memilih data dr jadual guru
$arahan_cari_guru="select* from guru order by tahap ASC";

# melaksanakan arahan sql diatas
$laksana_cari_guru=mysqli_query($condb,$arahan_cari_guru);

# mengambil semua data yg ditemui
while ($data=mysqli_fetch_array($laksana_cari_guru))
{
	# umpak data kedlm tatasusunan
	$data_guru=array(
		'nama_guru'          =>          $data['nama_guru'],
		'nokp_guru'          =>          $data['nokp_guru'],
		'katalaluan_guru'    =>          $data['katalaluan_guru']
	);
	
	# memaparkan data dlm btk jadual baris demi baris
	echo"<tr>
		<td>".$data['nama_guru']."</td>
		<td>".$data['nokp_guru']."</td>
		<td>".$data['katalaluan_guru']."</td>
		<td>".$data['tahap']."</td>
		<td class='w3-center'>
		
    <a href='guru_kemaskini.php?".http_build_query($data_guru)."' title='Kemaskini' > <script src='https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js'></script>
	<lord-icon
		src='https://cdn.lordicon.com/wloilxuq.json'
		trigger='hover'
		colors='primary:#121331,secondary:#000000'
		scale='60'
		style='width:60px;height:60px'>
	</lord-icon>
	 </a>
	 
    <a href='padam.php?jadual=guru&medan=nokp_guru&kp=".$data['nokp_guru']."' title='Padam' onClick=\"return comfirm('Sebelum memadan data guru, pastikan beliau tidak mempunyai kelas terlebih dahulu')\"><script src='https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js'></script>
	<lord-icon
		src='https://cdn.lordicon.com/eezceylz.json'
		trigger='hover'
		colors='primary:#121331,secondary:#000000'
		style='width:60px;height:60px'>
	</lord-icon>
	</a> 
	
	</td>
		</tr>";
}
?>
</table>
</div>
<?PHP include('footer_guru.php'); ?>