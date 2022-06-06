<?PHP 
# Memanggil header_guru.php
include('header_guru.php'); 

# ----- bahagian untuk menyimpan data set_soalan baru

# Menyemak kewujudan data POST
if(!empty($_POST))
{
    # Mengambil data POST
    $topik  =   mysqli_real_escape_string($condb,$_POST['topik']);
    $arahan =   mysqli_real_escape_string($condb,$_POST['arahan']);
    $jenis  =   $_POST['jenis'];
    $tarikh =   $_POST['tarikh'];

    # Menetapkan masa kuiz
    if($jenis=='Latihan')
    $masa   =   "Tiada";
    else
    $masa   =   mysqli_real_escape_string($condb,$_POST['masa']);
    
    # menyemak kewujudan data yang diambil
    if(empty($topik) or empty($arahan) or empty($jenis)or empty($tarikh)or empty($masa))
    {
        #jika terdapat pembolehubah yang tidak mempunyai nilai, aturcara akan dihentikan
        die("<script>alert('Sila lengkapkan maklumat');
        window.location.href='soalan_set.php';</script>");
    }

    # Arahan untuk menyimpan data set_soalan baru
    $arahan_simpan="insert into set_soalan
        (topik,arahan,jenis,tarikh,masa,nokp_guru)
        values
        ('$topik','$arahan','$jenis','$tarikh','$masa','".$_SESSION['nokp_guru']."')";

    # Melaksanakan arahan untuk menyimpan data
    if(mysqli_query($condb,$arahan_simpan))
    {
        # data berjaya disimpan
        echo "<script>alert('Pendaftaran BERJAYA.');
        window.location.href='soalan_set.php';</script>";
    }
    else
    {
        # data gagal disimpan
        echo "<script>alert('Pendaftaran GAGAL.');
        window.location.href='soalan_set.php';
        </script>";
    }
}

?>
<!-- bahagian untuk memaparkan senarai set soalan -->
<div class='w3-panel w3-hover-border-grey w3-leftbar w3-light-grey'>
<h3>Daftar Set Soalan</h3>
</div>
<?PHP include('../butang_saiz.php'); ?>
<div class='w3-responsive'>
<table border='1' id='besar' class='w3-table w3-hoverable w3-border-0 w3-margin-top w3-text-black'>
    <tr class='w3-khaki'>
        <td>Topik</td>
        <td>Arahan</td>
        <td>Jenis</td>
        <td>Tarikh</td>
        <td>Masa</td>    
        <td></td>   
    </tr>
    <tr>
    <!-- bahagian borang untuk mendaftar set soalan yang baru -->
        <form action='' method='POST'>
            <td><textarea class='w3-input' name='topik' rows="4" cols="25"></textarea></td>
            <td><textarea class='w3-input' name='arahan' rows="4" cols="25"></textarea></td>
            <td>
                <select class='w3-select' name='jenis'>
                    <option value selected disabled>Pilih</option>
                    <option value='Latihan'>Latihan</option>
                    <option value='Kuiz'>Kuiz</option>
                </select>
            </td>
            <td><input class='w3-input' type='date' name='tarikh'></td>
            <td><input class='w3-input' type='number' name='masa' placeholder='Dalam minit'></td>
            <td><input class=' w3-button w3-khaki w3-block w3-round-xlarge' type='submit' value='Simpan'></td>
        </form> 
    </tr>

<?PHP
# arahan untuk memilih data dari jadual set soalan
$arahan_set     =   "select* from set_soalan order by no_set DESC";

# melaksanakan arahhan untuk memilih data
$laksana_set    =   mysqli_query($condb,$arahan_set);

# pembolehubah $data mengambil data yang ditemui
while ($data=mysqli_fetch_array($laksana_set))
{
    # mengumpukkan data yang ditemui ke dalam tatasusunan $data_get
    $data_get=array(
        'no_set'    =>  $data['no_set'],
        'topik'     =>  $data['topik'],
        'arahan'    =>  $data['arahan'],
        'jenis'     =>  $data['jenis'],
        'tarikh'    =>  $data['tarikh'],
        'masa'      =>  $data['masa'],
        'nokp_guru' =>  $data['nokp_guru']
    );

    # Memaparkan data yang diambil baris demi baris
    echo "<tr>
        <td>    ".$data['topik']."  </td>
        <td>    ".$data['arahan']." </td>
        <td>    ".$data['jenis']."  </td>
        <td>    ".$data['tarikh']." </td>
        <td>    ".$data['masa']."   </td>
        <td clas='w3-center'>
             <a href='soalan_daftar.php?no_set=".$data['no_set']."&topik=".$data['topik']."' title='Soalan'><script src='https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js'></script>
             <lord-icon
                 src='https://cdn.lordicon.com/nocovwne.json'
                 trigger='hover'
                 colors='primary:#121331,secondary:#000000'
                 style='width:60px;height:60px'>
             </lord-icon>
             </a>

             <a href='soalan_set_kemaskini.php?".http_build_query($data_get)."' title='Kemaskini' > <script src='https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js'></script>
             <lord-icon
                 src='https://cdn.lordicon.com/wloilxuq.json'
                 trigger='hover'
                 colors='primary:#121331,secondary:#000000'
                 scale='60'
                 style='width:60px;height:60px'>
             </lord-icon>
             </a>
          

             <a href='padam.php?jadual=set_soalan&medan=no_set&kp=".$data['no_set']."' 
            onClick=\"return confirm('Anda pasti anda ingin memadam data ini.')\" title='Padam' onClick=\"return comfirm('Sebelum memadan data guru, pastikan beliau tidak mempunyai kelas terlebih dahulu')\"><script src='https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js'></script>
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
<?PHP include('footer_guru.php'); ?>
