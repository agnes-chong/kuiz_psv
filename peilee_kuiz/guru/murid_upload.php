<?PHP
# memanggil fail header_guru.php
include('header_guru.php');
?>
<!-- borang untuk memuat naik fail data -->
<div class='w3-panel w3-hover-border-grey w3-leftbar w3-light-grey'>
<h3>Upload Data Murid</h3>
</div>

<div class='w3-container w3-left w3-white w3-card w3-round-large'>
<?PHP include('../butang_saiz.php'); ?>
<form class='w3-margin-top w3-margin-bottom' action='' method='POST' action='upload.php'
enctype='multipart/form-data'>
  Pilih Fail CSV untuk di import :<br>
  <input type='file' name='file' required/>
  <button class='w3-button w3-khaki w3-round-xlarge' type='submit' name='btn-upload'>upload</button>
</form>
</div>

<?PHP
# Menyemak kewujudan data
if (isset($_POST['btn-upload'])){
  $namafailsementara=$_FILES["file"]["tmp_name"];
  
  # mengambil nama fail
  $namafail = $_FILES['file']['name'];
  
  #mengambil jenis fail
  $jenisfail = pathinfo($namafail,PATHINFO_EXTENSION);
  
  # menguji jenis fail dan saiz fail
  if($_FILES["file"]["size"] > 0 AND $jenisfail=="csv")
  {
    # membuka fail yang diambil
    $failyangdataingindiupload = fopen($namafailsementara, "r");
    # Umpuk nilai awal pembilang
    $counter=1;
    $bil_berjaya=0;
    $jum_data=0;
    # mendapatkan data dari fail fail
    while (($data = fgetcsv($failyangdataingindiupload, 10000, ",")) !== FALSE)
    {
	  # Mengambil data dari setiap cell pada fail csv
      $nama           =   mysqli_real_escape_string($condb,$data[0]);
      $nokp           =   mysqli_real_escape_string($condb,$data[1]);
      $katalaluan     =   mysqli_real_escape_string($condb,$data[2]);
      $id_kelas       =   mysqli_real_escape_string($condb,$data[3]);
	  
      if ($counter>1)
      {
# arahan untuk menyimpan data murid
$arahan_simpan = "INSERT into murid
(nama_murid, nokp_murid,katalaluan_murid,id_kelas)
values
('$nama','$nokp','$katalaluan','$id_kelas')";

# Melaksanakan arahan untuk menyimpan data
        if(mysqli_query($condb,$arahan_simpan))
		{
          # mengira bilangan data yang berjaya disimpan
          $bil_berjaya++;
        }
      }
	  
      $jum_data++;
    $counter++;
    }
  fclose($failyangdataingindiupload);
}
else
echo"<script>alert('Hanya fail berformat CSV sahaja dibenarkan'); </script>";

# Memaparkan popup bilangan data yang berjaya dikemaskini
if($bil_berjaya>0)
{
echo "<script>alert('Import fail data selesai. $bil_berjaya data berjaya disimpan');
window.location.href = 'murid_senarai.php';</script>";
}
else
{
echo "<script>alert('Import fail GAGAL disimpan');
window.location.href = 'murid_upload.php';</script>";
}
}
?>
<?PHP include('footer_guru.php'); ?>