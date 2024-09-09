<!DOCTYPE html>
<html>
<head>

<title>Registracija</title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
	

<!--BOOSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!--BOOSTRAP -->

</head>
<body>

<?php

	$povezava = mysqli_connect("localhost", "root", "", "expense manager")
	or die("Povezava ni uspela: " . mysqli_error($povezava)); 
	
	mysqli_set_charset($povezava, "utf8");
	
	if(!empty($_POST['registracija']))
	{
		$email = $_POST['email'];
		$email_poizvedba = "SELECT * FROM stranka WHERE Email = '$email'";
		$rezultat = mysqli_query($povezava, $email_poizvedba);
		$prestej = mysqli_num_rows($rezultat);
		if($prestej > 0)
		{
			echo '<script type="text/javascript"> alert("Ta E-mail je že zaseden") </script>';
		}
		else
		{
			echo '<script type="text/javascript"> alert("Registracija je uspela! Dobrodošli na našemu portalu. Za vstop se prijavite tukaj.");
			window.location.href="prijava.php";</script>';
			
			$imeStranke = $_POST["ime"];
			$priimekStranke = $_POST["priimek"];
			$email = $_POST["email"];
			$geslo = $_POST["geslo"];
			
			$dodaj_stranko = "INSERT INTO stranka (ImeStranke, PriimekStranke, Email, Geslo) VALUES('$imeStranke','$priimekStranke' ,'$email' ,'$geslo')";
			
			if(!mysqli_query($povezava, $dodaj_stranko))
			{
				die('Napaka: ' . mysqli_error($povezava));
			}
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

	<form method="POST" action="" class="obrazec">
	
		<h1 class="obrazec_naslov">Registracija</h1>
		
		<input type="text" class="polje" placeholder="Ime" name="ime" required>
		<input type="text" class="polje" placeholder="Priimek" name="priimek" required> 
		<input type="email" class="polje" placeholder="E-mail" name="email" required>
		<input type="password" class="polje" placeholder="Geslo" name="geslo" required>    
		<input type="submit" class="btn-registriraj" name="registracija" value="Registriraj se" onclick=> 

	</form>

</div>

</body>
</html>