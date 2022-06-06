<?PHP
# memulakan fungsi session_start
session_start();

# menyemak kewujudan data nokp, katalaluan dan jenis.
if(empty($_POST['nokp']) or empty($_POST['katalaluan']) or empty($_POST['jenis']))
{
    # menghentikan aturcara jika data diatas tidak wujud
    die("<script>alert('Sila masukkan nokp dan katalaluan.');
    window.location.href='index.php';</script>");
}

# Set pembolehubah jika jenis pengguna adalah murid
if($_POST['jenis']=='murid')
{
     $jadual    =   "murid" ;
	 $medan1    =   "nokp_murid" ;
	 $medan2    =   "katalaluan_murid" ;
	 $medan3    =   "nama_murid" ;
	 $lokasi    =   "murid/pilih_latihan.php" ;
}

# set pembolehubah jika jenis pengguna adalah guru
else if($_POST['jenis']=='guru')
{
     $jadual     =    "guru" ;
	 $medan1     =    "nokp_guru" ;
	 $medan2     =    "katalaluan_guru" ;
	 $medan3     =    "nama_guru" ;
	 $lokasi     =    "guru/index.php" ;
}
# memanggil fail connection.php
include('connection.php');

# mengambil dan menapis data POST
$nokp             =     mysqli_real_escape_string($condb,$_POST['nokp']);
$katalaluan       =     mysqli_real_escape_string($condb,$_POST['katalaluan']);

# arahan SQL untuk membandingkan data 
$arahan_login    =     "select* from $jadual
where $medan1    =     '$nokp'
and   $medan2    =     '$katalaluan'
limit 1";

# melaksanakan arahan login
$laksana_login    =      mysqli_query($condb,$arahan_login);

# jika terdapat 1 data ditemui sepadan
if(mysqli_num_rows($laksana_login)==1)
{
	 # login berjaya, umpukan nilai pembolehubah session
	 $data                   =     mysqli_fetch_array($laksana_login);
     $_SESSION[$medan3]      =     $data[$medan3];
	 $_SESSION[$medan1]      =     $data[$medan1];
	 echo"<script>window.location.href='$lokasi';</script>";
}
else
{
	#login gagal
	echo "<script>alert('Login Gagal');	
	window.history.back();</script>";
}
	
# menutup hubungan antara sistem dan pangkalan data
mysqli_close($condb);
?>