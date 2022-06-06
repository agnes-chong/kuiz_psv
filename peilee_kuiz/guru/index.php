<?PHP 
# memanggil fail header.php
include('header_guru.php');

# Memaparkan nama guru dan tahap
echo "
<div class='w3-panel w3-hover-border-grey w3-leftbar w3-light-grey'>
  <p>
  Nama Guru: ".$_SESSION['nama_guru']."(".$_SESSION['tahap'].")
  </p>
</div>

";
?>

<!-- Memaparkan senarai latihan terkini -->
Senarai Latihan Terkini
<div class='w3-responsive'>
<table border='1' id='besar' class='w3-table w3-hoverable w3-border-0 w3-margin-top'>

        <tr class='w3-khaki'>
        	<td>Topik</td>
        	<td>Kelas</td>
        	<td>Nama Guru</td>
        </tr>
        <?php
        # Arahan untuk mencari data guru, kelas dan set_soalan
        $arahan_latihan="SELECT* FROM set_soalan, guru,kelas 
        WHERE 
                   set_soalan.nokp_guru = guru.nokp_guru
        AND        kelas.nokp_guru      = guru.nokp_guru
        ORDER BY   set_soalan.tarikh ASC";

        # melaksanakan arahan carian di atas
        $laksana_latihan=mysqli_query($condb,$arahan_latihan);

        #mengambil data dan memaparkan semula data tersebut
        while ($rekod=mysqli_fetch_array($laksana_latihan))
        {
            echo "
            <tr>
                <td>".$rekod['topik']."</td>
                <td>".$rekod['ting']." ".$rekod['nama_kelas']."</td>
                <td>".$rekod['nama_guru']."</td>
            </tr>";
        }

        ?>
        </table>
    </div>
<?php include('footer_guru.php'); 
?>