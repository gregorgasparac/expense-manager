<?php

session_start();
if(!$_SESSION["userID"]){
	header("Location: index.html");
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Vnos stroškov</title>

<!--BOOSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<!--BOOSTRAP -->

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

</head>
<body>
	

<?php

$povezava = mysqli_connect("localhost", "root", "", "expense manager")
or die("Povezava ni uspela: " . mysqli_error($povezava));

?>

<nav class="navbar navbar-expand-sm justify-content-end" style="background-color: #228B22;"> 
		<ul class="nav justify-content-end">
		  <li class="nav-item">
			<a class="nav-link" style="color:white; font-size: 30px;" href="vnos_stroskov.php">Vnos</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" style="color:white; font-size: 30px;" href="zgodovina_stroskov.php">Zgodovina</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" style="color:white; font-size: 30px;" href="odjava.php">Odjava</a>
		  </li>
		</ul>
</nav>


<h1 class="stroski_naslov">VNOS STROŠKOV</h1>

<form action="" method="post" class="vnos">
	
	<label for="vrednost"><b>Vrednost</b></label>
	<input type="number" step="0.01"  name="vrednost" style="margin: 10px 10px 50px 10px;"  required>
	
	<label for="imestroska"><b>Ime</b></label>
	<input type="text" name="imestroska" style="margin: 10px 10px 50px 10px;" required>
	
	<br>
	
	<label for="kategorija"><b>Kategorija</b></label>
	<select name="kategorija" style="margin: 10px 50px 10px 10px;" required>
			
		<?php 
			$kategorije = mysqli_query($povezava, "SELECT * FROM kategorija");
			
			while($vrstica = mysqli_fetch_assoc($kategorije))
			{
				echo "<option value=\"" . $vrstica['IDKategorija'] . "\">" . $vrstica['ImeKategorije'] . "</option>";
			}
			
		?> 
		
	</select>
			
	<label for="datum"><b>Datum</b></label>
	<input type="date" name="datum" style="margin: 10px 10px 10px 10px;" required>
	
	<input type="submit" name="vnesi" value="Vnesi" class="btn-vnesi">
</form>
			
<hr>	

</body>
</html>

<?php

if(isset($_POST['vnesi']))
{
	$vrednost = $_POST['vrednost'];
	$imeStroska = $_POST['imestroska'];
	$kategorija = $_POST['kategorija'];
	$datum = $_POST['datum'];
	$IDStranke = $_SESSION["userID"];
	
	$dodaj = "INSERT INTO stroski (ImeStroska, Vrednost, IDStranke, IDKategorije, DatumStroska) VALUES ('$imeStroska', '$vrednost', '$IDStranke', '$kategorija', '$datum')"; 
	
	if (!$povezava) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	if ($vrednost > 0){
	
		$dodaj_izvedi = mysqli_query($povezava, $dodaj);
		
		
		
		if($dodaj_izvedi)
		{
			echo '<script type="text/javascript"> alert("Podatki so bili shranjeni") </script>';
			/* header("location: index.html"); */
		}
		else
		{
			echo '<script type="text/javascript"> alert("Podatki niso bili uspesno shranjeni") </script>';
		}
	}
	else {
		echo '<script type="text/javascript"> alert("Vrednost mora biti večja od 0.");
			window.location.href="vnos_stroskov.php";</script>';
	}
}

$IDStranke = $_SESSION["userID"];
$stroski_poizvedba ="SELECT stroski.Vrednost, stroski.ImeStroska, stroski.DatumStroska, kategorija.ImeKategorije, stroski.IDStrosek
FROM stroski 
LEFT JOIN kategorija
ON stroski.IDKategorije = kategorija.IDKategorija
WHERE IDStranke='$IDStranke'
ORDER BY stroski.DatumStroska DESC";

$rezultat_stroski = mysqli_query($povezava, $stroski_poizvedba);

echo "<table class='tabela_vnos'>
		<tr style='height:50px'>
			<th style='width:20%'>Vrednost (€)</th>
			<th style='width:20%'>Ime stroška</th>
			<th style='width:20%'>Kategorija</th>
			<th style='width:20%'>Datum</th>
			<th style='width:20%'></th>
		</tr>";
	
while($vrstica = mysqli_fetch_array($rezultat_stroski))
{
	echo "<tr>";
	echo "<td>" . $vrstica['Vrednost'] . "</td>";
	echo "<td>" . $vrstica['ImeStroska'] . "</td>";
	echo "<td>" . $vrstica['ImeKategorije'] . "</td>";
	echo "<td>" . $vrstica['DatumStroska'] . "</td>";
	echo "<td><a style='color: black' href = 'izbrisi_vrstico.php?ID=$vrstica[IDStrosek]'>Izbriši</td>";
	echo "</tr>";
}
	echo "</table>";
	
?>
		