<?PHP
# Memulakan fungsi session 
session_start();

# Memanggil fail guard_guru.php
include ('guard_guru.php');

# Memanggil fail connection dari folder utama
include ('../connection.php');

# Menguji pembolehubah session tahap mempunyai nilai atau tidak
if(empty($_SESSION['tahap']))
{
    # proses untuk mendapatkan tahap pengguna yang sedang login samada admin atau guru
    $arahan_semak_tahap="select* from guru where
    nokp_guru   =   '".$_SESSION['nokp_guru']."'
    limit 1";
    $laksana_semak_tahap=mysqli_query($condb,$arahan_semak_tahap);
    $data=mysqli_fetch_array($laksana_semak_tahap);
    $_SESSION['tahap']=$data['tahap'];
}
?>
<!doctype HTML>
<html>
    <head>
        <title>Kuiz Dalam Talian</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@700&display=swap">
        <style>
        .w3-dm-sans {
            font-family: "DM Sans", Sans-serif;
        }
        </style>
    <head>
<body>

<!-- header -->
<div class="w3-container w3-pale-yellow ">
<h1 class="w3-dm-sans w3-xxlarge">Bahagian Guru / Administrator</h1>
</div>

<!-- menu -->
<div class="w3-bar w3-pale-yellow">
  <a href='index.php' class="w3-bar-item w3-button">Laman Utama</a>
  <a href='../logout.php' class="w3-bar-item w3-button w3-right w3-large w3-dm-sans" title='Log Keluar' script src='https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js'></script>
<lord-icon
    src="https://cdn.lordicon.com/gmzxduhd.json"
    trigger='hover'
    colors='primary:#121331,secondary:#000000'
    stroke='80'
    style='width:40px;height:40px'>
</lord-icon></a>

  <?PHP if($_SESSION['tahap']=='ADMIN'){ ?>
  <div class="w3-dropdown-hover">
    <button class="w3-button">Admin</button>
    <div class="w3-dropdown-content w3-bar-block w3-card">
      <a href='guru_senarai.php'  class="w3-bar-item w3-button">Maklumat Guru</a>
      <a href='murid_senarai.php' class="w3-bar-item w3-button">Pengurusan Murid</a>
      <a href='senarai_kelas.php' class="w3-bar-item w3-button">Pengurusan Kelas</a>
    </div>
  </div>
  <?PHP } ?>

  <div class="w3-dropdown-hover">
    <button class="w3-button">Guru</button>
    <div class="w3-dropdown-content w3-bar-block w3-card">
      <a href='soalan_set.php'class="w3-bar-item w3-button">Pengurusan Soalan</a>
      <a href='analisis.php' class="w3-bar-item w3-button">Analisis Prestasi</a>
      
    </div>
  </div>

</div>

<!-- isi kandungan -->
<div class="w3-container">