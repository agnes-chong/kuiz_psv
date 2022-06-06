<?PHP
# memanggil fail header.php dan connection.php
include('header.php');
include('connection.php');

# menguji kewujudan data POST yang dihantar oleh bahagian borang di bawah
if(!empty($_POST))
{
	# mengambil dan menapis data POST
	$nama          =      mysqli_real_escape_string($condb,$_POST['nama']);
	$nokp          =      mysqli_real_escape_string($condb,$_POST['nokp']);
    $katalaluan    =      mysqli_real_escape_string($condb,$_POST['katalaluan']);
	$id_kelas      =      $_POST['id_kelas'];
	
	# menyemak kewujudan data yang dimasukkan.
	if (empty($nama) or empty($nokp) or empty($katalaluan) or empty($id_kelas))
	{
		die("<script>alert('Sila lengkapkan maklumat');
		window.history.back();</script>");
	}
	
	# had atas dan had bawah : sebagai data validation
	if(strlen($nokp)!=12 or !is_numeric($nokp))
	{
        die("<script>alert('Ralat No K/P.');
	    window.history.back();</script>");
	}
	# arahan untuk menyimpan data murid yang dimasukkan
	$arahan_simpan="insert into murid
	(nama_murid,nokp_murid,katalaluan_murid,id_kelas)
	values
	('$nama','$nokp','$katalaluan','$id_kelas')";
	
	# laksanakan arahan dalam block if
	if(mysqli_query($condb,$arahan_simpan))
	{
		# data berjaya disimpan. papar popup
		echo "<script>alert('Pendaftaran BERJAYA.');
		window.location.href='index.php';</script>";
	}
	else
	{
		# data gagal disimpan papar popup
		echo "<script>alert('Pendaftaran GAGAL.');
		window.history.back();</script>";
	}
	
}
?>
<div class="w3-row">
  <div class="w3-third w3-container">
	<!-- Bahagian borang untuk mendaftar murid baru -->
<h3>Pendaftaran Murid Baru</h3>
<form action = '' method = 'POST'>
     <label><b class="w3-dm-sans">Nama Murid</b></label>        
	 <input class="w3-input w3-animate-input" type  = 'text'     style="width:40%" name ='nama'><br>

	 <label><b class="w3-dm-sans">No KP Murid</b></label>        
	 <input class="w3-input w3-animate-input" type  = 'text'     style="width:40%" name = 'nokp'><br>
	
	 <label><b class="w3-dm-sans">Kata Laluan</b></label>      
	 <input class="w3-input w3-animate-input" type  = 'password' style="width:40%" name = 'katalaluan'><br>
	 
	 <label><b class="w3-dm-sans">Kelas</b></label><br>
	 <select class="w3-select" name = 'id_kelas' style="width:40%">
	 <option value selected disable>Pilih</option>
	
<?PHP
# arahan untuk mencari semua data dari jadual kelas
$sql="select* from kelas";

# melaksanakan arahan mencari data
$laksana_arahan_cari = mysqli_query($condb,$sql);

# pemboleh ubah $rekod_bilik mengambil data yang ditemui baris demi baris
while ($rekod_bilik = mysqli_fetch_array($laksana_arahan_cari))
{
# memaparkan data yang ditemui dalam element <option></option>
echo "<option value=".$rekod_bilik['id_kelas'].">".$rekod_bilik['ting']."
".$rekod_bilik['nama_kelas']."</option>";
}
?>

</select><br>
<input class="w3-button w3-khaki w3-margin-top w3-round-xxlarge" type='submit' value='Daftar'>
<a class="w3-button w3-khaki w3-margin-top w3-round-xxlarge" href='index.php'>Kembali ke Laman Log Masuk</a>
</form>
  </div>
  <div class="w3-twothird w3-container">
  <div class='w3-container w3-margin-top w3-margin-bottom'>
  <div class="w3-content" >
    <img class="mySlides w3-animate-left  w3-animated-fading w3-image" src="images/3.png">
	<img class="mySlides w3-animate-right w3-animated-fading w3-image" src="images/4.png">
  </div>
  </div>
  </div>

<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 2500);    
}
</script>



<?PHP
mysqli_close($condb);
include ('footer.php');
?>