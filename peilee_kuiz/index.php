<?PHP  
# memanggil fail header.php  
include ('header.php');  
include ('iklan_atas.php');
?>  
<!-- antara muka untuk daftar masuk / login -->  
<table width='100%' class='w3-table'>  
    <tr>  
        <td align='center' width='30%'>  
            <h3>Login Pengguna</h3>  
            <form action='login.php' method='POST'>  
            <label><b class="w3-dm-sans">No Kad Pengenalan</b></label>  
            <input class="w3-input w3-animate-input" name='nokp' placeholder='12 angka nombor' type='text' style="width:40%" ><br>   
            
            <label><b class="w3-dm-sans">Kata Laluan</b></label>  
            <input class="w3-input w3-animate-input" name='katalaluan' type='password' style="width:40%" >
                  <input type='radio'  class="w3-radio"    name='jenis' value='murid' checked> Murid  
                  <input type='radio'  class="w3-radio"    name='jenis' value='guru'> Guru<br>
                  <input class="w3-margin-top w3-button w3-khaki w3-round-xxlarge" type='submit' value='Login'>  
                  <a     class="w3-margin-top w3-button w3-khaki w3-round-xxlarge" href='signup.php'> Daftar Murid Baru </a>
                </form>  
                <!-- pautan untuk mendaftar murid baru -->   
         </td>  
         <td>  
        <!--Senarai Set Latihan Terkini -->  
        <h3>Senarai Latihan Terkini</h3>
        <table border='1' class='w3-border-0 w3-table w3-hoverable'> 
        <tr class='w3-khaki'>  
            <td>Topik</td>  
            <td>Kelas</td>  
            <td>Nama Guru</td> 
        </tr>   
        <?PHP  
        # memanggil fail connection.php  
        include('connection.php');  
  
        # arahan sql untuk mencari data set soalan yang terkini  
        $arahan_latihan="SELECT* FROM set_soalan, guru, kelas  
        WHERE  
                     set_soalan.nokp_guru           =         guru.nokp_guru  
        AND          kelas.nokp_guru                =         guru.nokp_guru  
        ORDER BY     set_soalan.tarikh ASC ";  
  
        # melaksanakan arahan SQL diatas  
        $laksana_latihan=mysqli_query($condb,$arahan_latihan);  
  
        # mengambil dan memaparkan senarai set soalan, tingkatan yang terlibat dan guru  
        while($rekod=mysqli_fetch_array($laksana_latihan))  
        {  
            echo " <tr>  
                 <td>".$rekod['topik']."</td>  
                 <td>".$rekod['ting']." ".$rekod['nama_kelas']."</td>  
                 <td>".$rekod['nama_guru']."</td>  
            </tr>";  
        }  
        mysqli_close($condb);  
        ?>  
        </table>  
        </td>  
    </tr>  
 </table>  
  
 <?PHP  
# Memanggil fail footer.php  
include('footer.php');  
  
?>