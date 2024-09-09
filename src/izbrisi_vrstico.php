<?php

$povezava = mysqli_connect("localhost", "root", "", "expense manager")
or die("Povezava ni uspela: " . mysqli_error($povezava));

$IDStrosek = $_GET['ID']; 

$izbrisi= "DELETE FROM stroski WHERE IDStrosek = '$IDStrosek'"; 

$rezultat_izbrisi = mysqli_query($povezava, $izbrisi);

if($rezultat_izbrisi)
{
    echo '<script type="text/javascript"> alert("Strošek je bil izbrisan.");
			window.location.href="vnos_stroskov.php";</script>';
}

?>

