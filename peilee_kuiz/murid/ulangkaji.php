<?PHP
# memanggil fail header.php dan connection.php dari folder luaran
include ('../header.php');
include ('../connection.php');

# menyemak kewujudan data GET dan session[nama_murid]
if(empty($_GET) or empty($_SESSION['nama_murid']))
{
	# jika tidak wujud. aturcara akan dihentikan
	die("<script>alert('Akses tanpa kebenaran');
	window.location.href='pilih_latihan.php';</script>");
}

# memecahkan data GET
$pecahkanbaris = explode("|",$_GET['kumpul']);

# mengumpukkan data yang dipecahkan kepada pembolehubah
list($bil_betul,$bil_soalan,$peratus,$bil_jawapan) = $pecahkanbaris;

# arahan untuk mencari jawapan pelajar berdasarkan nokp_murid dan no set soalan
$arahan_carian="SELECT*
from set_soalan,soalan,jawapan_murid,murid
where
set_soalan.no_set       =       soalan.no_set
AND soalan.no_soalan    =       jawapan_murid.no_soalan
AND murid.nokp_murid    =       jawapan_murid.nokp_murid
AND murid.nokp_murid    =       '".$_SESSION['nokp_murid']."'
AND soalan.no_set       =       '".$_GET['no_set']."'
";

# melaksanakan arahan mencari jawapan pelajar
$laksana_carian=mysqli_query($condb,$arahan_carian);

# memaparkan tajuk ulang kaji, skor dan markah
echo"<div class='w3-row w3-margin-top'>
<div class='w3-quarter w3-container'>
</div>

<div class='w3-half w3-container w3-card w3-round-xlarge'>";

echo "
<h3>Bahagian Ulangkaji</h3>
<h4>Anda telah selesai menjawab soalan 
dalam latihan/kuiz ini</h4>

Topik : ".$_GET['topik']."<br>

Skor : ".$bil_betul." / ".$bil_soalan."<br>

Peratus : ".$peratus."

<hr>";

$bil=0;

# mengambil data jawapan pelajar yang ditemui
while($rekod=mysqli_fetch_array($laksana_carian))
{
	# menguji soalan yang tidak dijawab
	
	
		$nilai_jawapan = $rekod['jawapan'];

	

	
	# memaparkan soalan dan jawapan bagi soalan
	echo "
	No Soalan : ".++$bil."<br>
	
	".$rekod['soalan']."<br>
	
	<img src='".$rekod['gambar']."'><br>
	
	<li>".$rekod['jawapan_a']." <br>
	<li>".$rekod['jawapan_b']."<br>
	<li>".$rekod['jawapan_c']."<br>
	<li>".$rekod['jawapan_d']."<br><br>
	
	Jawapan Sebenar : ".$rekod['jawapan_a']."<br>
	
	Jawapan anda : ".$nilai_jawapan."<br>
	
	Status : ".$rekod['catatan']."
	
<hr>";
}

echo "
<input class=' w3-block w3-margin-bottom w3-button w3-khaki w3-round-xlarge type='submit' value='cetak' onClick='window.print()'>
</div>

<div class='w3-quarter w3-container'>
</div>
</div>";




mysqli_close($condb);
?>
<?PHP include ('../footer.php'); ?>