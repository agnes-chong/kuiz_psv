<?PHP
# memulakan fungsi session_start bagi membolehkan pembolehubah super global session digunakan
session_start(); ?>

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
<div class="w3-container w3-pale-yellow">
    <h1 class="w3-dm-sans" align='center'>Kuiz Pendidikan Seni Visual Tingkatan 2</h1>
</div>
<!-- menu -->
<div class="w3-bar w3-pale-yellow">

<!-- Menu bahagian Murid -->
<?PHP if(!empty ($_SESSION) and basename($_SERVER['PHP_SELF']) != 'index.php'){ ?>
<?PHP echo "<span class='w3-bar-item w3-button'>Nama Murid : ". $_SESSION['nama_murid']."</span>"; ?>
<a class="w3-bar-item w3-button" href='pilih_latihan.php'>Laman Utama</a>
<a class="w3-bar-item w3-button" href='../logout.php'>logout</a>

<?PHP }
else
echo "<span class='w3-bar-item'>Selamat Datang</span>";
?>
</div>
<!-- Isi Kandungan -->
<div class='w3-container'>
    Isi Kandungan
</div>

<!-- footer -->
<div class='w3-container w3-pale-yellow'>
    <!-- Gunakan ayat yang lebih sesuai pada bahagian ini --> 
    <p>Hakcipta &copy 2020-2021 : Panitia Pendidikan Seni Visual</p>
    <p>Penafian : Pihak admin tidak bertanggungjawab atas kerugian dan kehilangan akibat penggunaan data yang terkandung dalam sistem ini</p>
</div>

</body>
</html>