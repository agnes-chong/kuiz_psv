<?PHP 
# memanggil fail header.php dan fail connection.php dari folder utama
include ('../header.php');
include('../connection.php');

# menyemak kewujudan data get
if(empty($_GET))
{
    #jika data get tidak wujud. aturcara akan dihentikan
    die("<script>alert('Akses tanpa kebenaran');
    window.location.href='pilih_latihan.php';</script>");
}
?>

<?PHP

# Menguji data get[Jenis]==kuiz
if($_GET['jenis']=="Kuiz")
{
    # memanggil fail timer2.php
    include('timer2.php');
    # memanggil fungsi timer_kuiz
    timer_kuiz($_GET['masa']);
}
?>

<!-- Memaparkan latihan untuk dijawab oleh pelajar-->
<h3 class='w3-center w3-roboto'>Soalan Latihan</h3>
<hr>
<form name='soalan_kuiz' action='jawap_semak.php?no_set=<?PHP echo $_GET['no_set']; ?>'method='POST'>
<?PHP include ('../butang_saiz.php'); ?>

<div class='w3-responsive'>
<table border='1' id='besar' class='w3-table w3-border-0 w3-hoverable w3-margin-top w3-text-black'>
<tr class='w3-khaki'>
     <td style="width:5%" >Bil</td>
     <td>Soalan</td>
</tr>

<?PHP
# Arahan untuk memilih soalan berdasarkan no set dan menyusunnya secara rawak (rand)
$arahan_pilih_soalan="select* from soalan where no_set='".$_GET['no_set']."'
order by rand()";

# melaksanakan arahan untuk memilih soalan
$laksana=mysqli_query($condb,$arahan_pilih_soalan);
$i=0;

# pembolehubah data mengambil data yang ditemui 
while ($data=mysqli_fetch_array($laksana))
{
    # memaparkan soalan dan jawapan
    echo"<tr>
    <td>".++$i."</td>
    <td>";
# mengumpukkan nama medan kepada tatasusunan
    $a=array("jawapan_a","jawapan_b","jawapan_c","jawapan_d");

    # menjadikan susunan jawapan secara rawak 
    shuffle($a);
    $xjawap='TIDAK MENJAWAB';

    # jika soalan mempunyai gambar, umpukan nama gambar
    if($data['gambar']!=" ")
    {
        $gambar=$data['gambar'];
    }
    else
    {
        $gambar=" ";
    }
        # memaparkan jawapan yang telah disusun secara rawak 
        echo $soalan=str_replace("'"," ",$data['soalan']);

# susunan value yang dihantar. Taip dengan penuh berhati-hati
# medan,jawapan, jawapan1, jawapan2, jawapan3, jawapan4, soalan, nilai jawapan_a, gambar
        echo"
        <br><img src='$gambar'><br>

<input class='w3-radio' type='radio' name='s".$data['no_soalan']."' value='".$a[0]."|".$data[$a[0]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'> <label>".$data[$a[0]]."</label><br>

<input class='w3-radio'type='radio' name='s".$data['no_soalan']."' value='".$a[1]."|".$data[$a[1]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'> <label>".$data[$a[1]]."</label><br>

<input class='w3-radio' type='radio' name='s".$data['no_soalan']."' value='".$a[2]."|".$data[$a[2]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'> <label>".$data[$a[2]]."</label><br>

<input class='w3-radio' type='radio' name='s".$data['no_soalan']."' value='".$a[3]."|".$data[$a[3]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'> <label>".$data[$a[3]]."</label>

<input class='w3-radio' type='radio' name='s".$data['no_soalan']."' value='tidak jawab|tidak jawab|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'  checked style='visibility: hidden'>

<br>";

echo"</td>
</tr>";
}
?>

</table>
</div>
<input class='w3-margin-top w3-button w3-khaki w3-block w3-round-xlarge'type='submit' value='Hantar'>

</form>
<?PHP include ('../footer.php'); ?>