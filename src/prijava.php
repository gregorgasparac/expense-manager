<!DOCTYPE html>
<html>
<head>

<title>Prijava</title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">	
	
<!--BOOSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!--BOOSTRAP -->

</head>
<body>

<?php 

session_start();

$povezava = mysqli_connect("localhost", "root", "", "expense manager")
or die("Povezava ni uspela: " . mysqli_error($povezava));

mysqli_set_charset($povezava, "utf8");

if(!empty($_POST['prijava']))
{
	$email = $_POST['email'];
	$geslo = $_POST['geslo'];
	
	$ID_poizvedba = "SELECT IDStranka FROM stranka WHERE Email = '$email' and Geslo = '$geslo'";
	
	$userID = mysqli_query($povezava, $ID_poizvedba);   //vrne tabelo
	
	$prestej_vrstice = mysqli_num_rows($userID);
	if($prestej_vrstice > 0)
	{
		$data_baza = mysqli_fetch_assoc($userID);   //associative array
		$_SESSION["userID"] = $data_baza["IDStranka"];   //iz arraya dobimo podatek, shranimo v sejno spremenljivko
		echo '<script> alert("Prijava je uspela!");
				window.location.href="vnos_stroskov.php"; </script>';
	}
	else
	{
		echo '<script> alert("Napačno uporabniško ime ali geslo!"); </script>';	
	}	
}

?>

<div class="ozadje">

	<nav class="navbar navbar-expand-sm justify-content-end" style="background-color: #228B22;"> 
		<ul class="nav justify-content-end">
		  <li class="nav-item">
			<a class="nav-link" style="color:white; font-size: 30px;" href="index.html">Domov</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" style="color:white; font-size: 30px;" href="registracija.php">Registracija</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" style="color:white; font-size: 30px;" href="prijava.php">Prijava</a>
		  </li>
		</ul>
	</nav>

	<form method="POST"  action ="" class="obrazec" style="height: 250px;">
	
		<h1 class="obrazec_naslov">Prijava</h1>
		
		<input type="email" class="polje" placeholder="E-mail" name="email" required>
		<input type="password" class="polje" placeholder="Geslo" name="geslo" required>    
		<input type="submit" class="btn-registriraj" name="prijava" value="Prijavi se" onclick=> 
		
	</form>

</div>

</body>
</html>