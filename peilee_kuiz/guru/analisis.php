<?PHP
# Memanggil fail header_guru.php
include('header_guru.php');
?>
<!-- sub tajuk laman -->
<div class='w3-panel w3-hover-border-grey w3-leftbar w3-light-grey'>
<h3>Analisis Prestasi Murid</h3>
</div>

<div class="w3-row">
  <div class="w3-third w3-container w3-card w3-round-xlarge">
<!-- Borang untuk memilih kelas dan set soalan -->
<form class='w3-margin' action='' method='POST'>

<!-- Memaparkan senarai kelas yang diajar oleh guru yang sedang login -->
<label class="w3-dm-sans"><b>Kelas</b></label>
<select class='w3-input' name='id_kelas'>
		<option value selected disabled>Pilih</option>
	<?PHP
	if($_SESSION['tahap']=='ADMIN')
	{
		# Jika guru yang sedang login adalah admin
		# Arahan untuk mencari semua kelas
		$sql="select* from kelas, guru
		where
		kelas.nokp_guru       =          guru.nokp_guru ";
	}
	else
	{
		# Sebaliknya jika guru yang sedang login bukan admin
		# Arahan untuk mencari semua kelas yang diajar oleh guru tersebut sahaja 
		$sql="select* from kelas, guru 
		where  
		       kelas.nokp_guru        =       guru.nokp_guru
		and	   kelas.nokp_guru        =       '".$_SESSION['nokp_guru']."' ";
	}
	
	# Melaksanakan arahan mencari data
	 $laksana_arahan_cari=mysqli_query($condb,$sql);

    # Pemboleh ubah $rekod mengambil data yang ditemui baris demi baris
    while ($rekod=mysqli_fetch_array($laksana_arahan_cari))
    {
	    # Memaparkan data yang ditemui dalam element <option></option>
	     echo "<option value=".$rekod['id_kelas'].">
	          ".$rekod['ting']." ".$rekod['nama_kelas']."</option>";
    }
?>
</select>
<br>

<!-- Memaparkan set soalan yang pernah dimasukkan oleh guru -->
<label class="w3-dm-sans"><b>Topik</b></label>
<select class='w3-select' name='no_set'>
		<option value selected disabled>Pilih</option>
	<?PHP
	if($_SESSION['tahap']=='ADMIN')
	{
		# Jika admin.
		# Arahan untuk mencari semua set soalan
		$sql2="select* from set_soalan, guru
		where
		set_soalan.nokp_guru       =          guru.nokp_guru ";
	}
	else
	{
		# Sebaliknya jika bukan admin
		# Arahan untuk memaparkan set soalan yang dihasilkan oleh guru tersebut sahaja 
		$sql="select* from set_soalan, guru 
		where  
		       set_soalan.nokp_guru        =       guru.nokp_guru
		and	   set_soalan.nokp_guru        =       '".$_SESSION['nokp_guru']."' ";
	}
	
	# Melaksanakan arahan mencari data
	 $laksana_arahan_cari2=mysqli_query($condb,$sql2);

    # Pemboleh ubah $rekod mengambil data yang ditemui baris demi baris
    while ($rekod2=mysqli_fetch_array($laksana_arahan_cari2))
    {
	    # Memaparkan data yang ditemui dalam element <option></option>
	     echo "<option value=".$rekod2['no_set'].">
	          ".$rekod2['topik']."</option>";
    }
?>
</select>
<br>
<td><input class=' w3-button w3-khaki w3-round-xlarge w3-margin-top' type='submit'   value='Papar Keputusan'>   </td>
</form>
  </div>
  <div class="w3-twothird w3-container">


  
  </div>
  
</div>


<?PHP
#---------- Bahagian untuk memaparkan senarai nama murid, skor dan jumlah markah.

# Menyemak kewujudan  data POST (tingkatan dan topik latihan) yang di hantar melalui borang diatas
if(!empty($_POST))
{
	# Mengambil nilai POST
    $id_kelas      =      $_POST['id_kelas'];
	$no_set        =      $_POST['no_set'];
	
	# ---- Bahagian untuk mendapatkan nama kelas berdasarkan id_kelas yang hantar
	# Arahan untuk mencari semua data kelas berdasarkan id_kelas yang dipilih
	$arahan_kelas="select* from kelas where id_kelas='$id_kelas'";
	
	# Melaksanakan arahan carian di atas 
    $laksana_kelas   =    mysqli_query($condb,$arahan_kelas);

    # Pembolehubah data1 mengambil data yang ditemui
    $data1            =    mysqli_fetch_array($laksana_kelas);
	
	# Umpukan gabungan data tingkatan dan nama kelas 
	$nama_kelas      =   $data1['ting'].$data1['nama_kelas'];
	
	# ---- Bahagian untuk mendapatkan nama topik set latihan berdasarkan no_set yang dihantar
	# Arahan untuk mencari semua data set_soalan berdasarkan no_set yang dipilih
	$arahan_topik="select* from set_soalan where no_set='$no_set'";
	
	# Melaksanakan arahan set_soalan untuk mencari di atas 
    $laksana_topik   =    mysqli_query($condb,$arahan_topik);

    # Mengambil data set_soalan yang ditemui
    $data2           =    mysqli_fetch_array($laksana_topik);
	
	# Umpukan data topik
	$nama_topik      =   $data2['topik'];
	
	# Arahan sql untuk memilih pelajar berdasarkan id_kelas yang dihantar
	$arahan_pilih="select*
	          from murid, kelas
			  where   
			            murid.id_kelas          =          kelas.id_kelas
			  and  		murid.id_kelas          =          '$id_kelas'
	          order by murid.nama_murid ASC";
			  
	# Melaksanakan arahan untuk memilih pelajar
	$laksana_pilih   =    mysqli_query($condb,$arahan_pilih);
	
	# Jika bilangan rekod yang ditemui lebih besar atau sama dengan 1
	if(mysqli_num_rows($laksana_pilih)>=1)
	{
		# Papar maklumat carian nama kelas dan topik
		echo"
		<br>Kelas : $nama_kelas
		<br>Topik : $nama_topik
		<br><button class='w3-button w3-margin-left w3-khaki w3-margin-bottom w3-margin-top w3-round-xlarge' onclick='window.print()'>Cetak Keputusan</button>";
		include ('../butang_saiz.php'); 
		echo"<table border='1' id='besar' class='w3-table w3-hoverable w3-border-0 w3-margin-top w3-text-black w3-roboto'>
		<div class='w3-responsive'>
		<tr class='w3-khaki'>
		    <td>Nama Murid</td>
			<td>Nokp Murid</td>
			<td>Skor</td>
			<td>Markah</td>
		</tr>";
	}
	else
	{
		echo"tiada data yang ditemui bagi kelas tersebut";
	}
	
# Fungsi skor menerima data no_set soalan dan nokp murid
function skor($no_set,$nokp_murid)
{
	# Memanggil fail connection dari folder luaran
	include ('../connection.php');
	
	# Arahan untuk mendapatkan data jawapan murid berdasarkan set soalan dan nokp murid
	$arahan_skor="SELECT*
	FROM jawapan_murid,set_soalan,soalan
	WHERE
	         set_soalan.no_set            =      soalan.no_set
	AND		 jawapan_murid.no_soalan      =      soalan.no_soalan
	AND		 jawapan_murid.nokp_murid     =      '$nokp_murid'
	AND		 set_soalan.no_set            =      '$no_set'      ";
	
	# Melaksanakan arahan diatas
    $laksana_skor     =      mysqli_query($condb,$arahan_skor);

    # Mengambil bilangan jawapan yang ditemui
    $bil_jawapan      =     mysqli_num_rows($laksana_skor);
    $bil_betul=0;

    # Jika bilangan jawapan yang ditemui >= 1
    if($bil_jawapan>=1)
    {
	# pembolehubah rekod mengambil data yg ditemui
	while($rekod=mysqli_fetch_array($laksana_skor))
	{
        # Mengira bilangan jawapan yang betul
        switch($rekod['catatan'])
        {
            case 'BETUL'      :  $bil_betul++; break;
            default           :  break;
        }
    }
    
        # Mengira markah berdasarkan bilangan jawapan betul
        $markah=$bil_betul/$bil_jawapan*100;

        # Memaparkan skor dan jumlah % markah
        echo " <td>".$bil_betul." / ".$bil_jawapan."</td>
               <td>".number_format($markah,0)." %</td> ";
    }
    else 
    echo "<td></td> <td>Belum Jawab</td>";
}
# Mengambil data yang ditemui
 while($data=mysqli_fetch_array($laksana_pilih))
{
	# Memaparkan data yang ditemui baris demi baris.
	echo"<tr>
	<td>".$data['nama_murid']."</td>
	<td>".$data['nokp_murid']."</td>";
	
	# Memanggil fungsi skor di atas dengan menghantar data no_set soalan dan nokp murid
	skor($no_set,$data['nokp_murid']);
	echo"</tr>";
    }
}
?>
</table>
<?PHP include('footer_guru.php'); ?>