<?php

session_start();
if(!$_SESSION["userID"]){
	header("Location: index.html");
}

?>

<!DOCTYPE html>
<html>
<head>

	<title>Zgodovina stroškov</title>
	
	<!--BOOSTRAP -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://cdn.plot.ly/plotly-2.8.3.min.js"></script>
	<!--BOOSTRAP -->
	
	<link rel="stylesheet" href="style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

</head>
<body>


<?php

$povezava = mysqli_connect("localhost", "root", "", "expense manager")
or die("Povezava ni uspela: " . mysqli_error($povezava));

$kategorije_tabela = mysqli_query($povezava, "SELECT * FROM kategorija");

$kategorije = [];

while($vrstica = mysqli_fetch_array($kategorije_tabela))
	{
		$kategorije[] = $vrstica['ImeKategorije'];
	}
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

<h1 class="stroski_naslov">ZGODOVINA STROŠKOV</h1>

<div class="float-child">

	<form action="" method="post" class="vnos">
		
		<label for="leto"><b>Leto</b></label>
		<input type="number" name="leto" style="margin:10px 10px 40px 10px;";required>
		
		<label for="mesec"><b>Mesec</b></label>
		<select name="mesec" required>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
		</select>
		
		<input type="submit" name="vnesi" value="Vnesi" class="btn-vnesi" onclick="pokaziGraf()">
	</form>

	<?php 

	if(!empty($_POST['vnesi']))
	{
		
		$IDStranke = $_SESSION["userID"];
		$leto = $_POST["leto"];
		$mesec = $_POST["mesec"];
		$mesec_naslov = "";
		
		switch ($mesec) {
		  case 1:
			$mesec_naslov = "Januar";
			break;
		  case 2:
			$mesec_naslov = "Februar"; 
			break;
		  case 3:
			$mesec_naslov = "Marec";
			break;
		  case 4:
			$mesec_naslov = "April";
			break;
		  case 5:
			$mesec_naslov = "Maj";
			break;
		  case 6:
			$mesec_naslov = "Junij";
			break;
		  case 7:
			$mesec_naslov = "Julij";
			break;
		  case 8:
			$mesec_naslov = "Avgust";
			break;
		  case 9:
			$mesec_naslov = "September";
			break;
		  case 10:
			$mesec_naslov = "Oktober";
			break;
		  case 11:
			$mesec_naslov = "November";
			break;
		  case 12:
			$mesec_naslov = "December";
			break;
		  
		}
		
		if($leto > 2000){
		
		$zgodovina_poizvedba ="SELECT stroski.ImeStroska, stroski.Vrednost, stroski.DatumStroska, kategorija.ImeKategorije
		FROM stranka
		LEFT JOIN stroski
		ON stranka.IDStranka=stroski.IDStranke
		LEFT JOIN kategorija
		ON kategorija.IDKategorija=stroski.IDKategorije
		WHERE IDStranke='$IDStranke' AND YEAR(DatumStroska) = '$leto' AND MONTH(DatumStroska) = '$mesec'
		ORDER BY stroski.DatumStroska DESC";

		$rezultat_zgodovina = mysqli_query($povezava, $zgodovina_poizvedba); 
		
		$sestevek = "SELECT SUM(stroski.Vrednost)
		FROM stranka
		LEFT JOIN stroski
		ON stranka.IDStranka=stroski.IDStranke
		LEFT JOIN kategorija
		ON kategorija.IDKategorija=stroski.IDKategorije
		WHERE IDStranke='$IDStranke' AND YEAR(DatumStroska) = '$leto' AND MONTH(DatumStroska) = '$mesec'";
		
		$rezultat_sestevek = mysqli_query($povezava, $sestevek); 
		
		while($vrstica = mysqli_fetch_array($rezultat_sestevek))
		{
			$strosek = $vrstica['SUM(stroski.Vrednost)'];
		
		}
		
		echo "<table id='tabela_stroskov'; class='tabela_zgodovina'>
				  <caption>$mesec_naslov, $leto</caption>
				  <tr style='height:50px'>
					<th colspan='5'>Vsota zneskov (€): $strosek </th>
				  </tr>
				  <tr style='height:50px'>
					<th style='width:25%'>Vrednost (€)</th>
					<th style='width:25%'>Ime stroška</th>
					<th style='width:25%'>Kategorija</th>
					<th style='width:25%'>Datum</th>
				  </tr>";
				  
		$strosek = array_fill(0, count($kategorije), 0);
		
		while($vrstica = mysqli_fetch_array($rezultat_zgodovina))
		{
			
			$index_kategorije = array_search($vrstica['ImeKategorije'], $kategorije);	
			$strosek[$index_kategorije] += $vrstica['Vrednost'];
			
			echo "<tr style='height:50px'>";
			echo "<td>" . $vrstica['Vrednost']  . "</td>";
			echo "<td>" . $vrstica['ImeStroska'] . "</td>";
			echo "<td>" . $vrstica['ImeKategorije'] . "</td>";
			echo "<td>" . $vrstica['DatumStroska'] . "</td>";
			echo "</tr>"; 

		}
		
		echo "</table>"; 
		
		} else {
			echo '<script type="text/javascript"> alert("Stroške je možno hraniti samo od leta 2000 naprej.");
			window.location.href="zgodovina_stroskov.php";</script>';
		}
	}
		
	?>
	
</div>	

<div id="graf" class="float-child" style="width:600px; height:500px; margin-top: 100px;"></div>

<script type="text/javascript">

	torta = document.getElementById('graf');
	
	setTimeout(pokaziGraf, 1000);
	function pokaziGraf(){
		var kategorije_js = <?php echo json_encode($kategorije); ?>; //iz php spremenljivke, ki je klicana iz baze dobimo vse kategorije
		var strosek_js = <?php echo json_encode($strosek); ?>;; //naredimo array
		var data = [{labels:kategorije_js, values:strosek_js, type:"pie"}];
		var layout = {title:"Stroski"};
		Plotly.newPlot(torta, data, layout);
	}
	
</script>














