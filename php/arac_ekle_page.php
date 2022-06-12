<?php 


$servername = "localhost";
$username = "root";
$password = "espn1997";
$dbname = "arac_kirala";

	$baglanti = new mysqli ($servername,$username,$password,$dbname);

	if($baglanti->connect_error) {
		echo "Bağlantı oluşmadı".$baglanti->connect_error;
		
	}else{
}

?>

<!-- ARABA EKLEME -->
<?php 

	if(isset($_POST["ekle"]))
	{
		$sql = "INSERT INTO arabalar(arac_vin,arac_adi,model_adi)values('".$_POST["vin"]."','".$_POST["araba_marka"]."','".$_POST["araba_model"]."')";
		
		$sql_two = "INSERT INTO arababilgi(arac_vin,plaka,kilometre,yakit)values('".$_POST["vin"]."','".$_POST["plaka"]."','".$_POST["kilometre"]."','".$_POST["yakit"]."')";
		
		$sonuc = mysqli_query($baglanti,$sql);
		$sonuc_two = mysqli_query($baglanti,$sql_two);
		if($sonuc)
		{
			//echo " araba marka veri eklendi";
			header("Location:arac_ekle_page.php");
		}else{
			echo " araba marka veri eklenmedi!!";
			//header("Location:arac_ekle_page.php");
		}
		
		if($sonuc_two)
		{
			echo " araba bilgi veri eklendi";
		}else{
			echo " araba bilgi veri eklenmedi!!";
		}
		
	}
?>

<!-- ARABA SİLME -->
<?php
	if(isset($_GET["sil"])){
		$gelenvin = $_GET["sil"];
		$sql_delete = "DELETE FROM `arabalar` WHERE `arabalar`.`arac_vin` = ".$gelenvin;
		mysqli_query($baglanti,$sql_delete);
		echo "basıldı".$gelenvin;
		header("Location:arac_ekle_page.php");
	}

?>

<!-- ARABALARI ÇEKME -->
<?php

	//$bul_araba = "SELECT * FROM arabalar,arababilgi ORDER BY arabalar.arac_vin = arababilgi.arac_vin DESC";
	$bul_araba = "SELECT * FROM arabalar join arababilgi on arabalar.arac_vin = arababilgi.arac_vin";

	$kayit_araba = $baglanti->query($bul_araba);

?>

<!doctype html>
<html lang="tr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	  
	  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

    <title>Hello, world!</title>
  </head>
  <body>
    

    
<div class="container-fluid mt-3">
  <div class="col-md-12 justify-content-center" style="background-color: #f0f0f0;">
	  
	  <a href="index.php" style="text-decoration: none;"><button type="button" class="btn btn-success mt-3 btn-block">Ana Sayfa Git</button></a>

  <!-- ARABA EKLEME KISMI -->
  <div class="row-md-12 d-flex justify-content-center p-3 m-2" id="musteri_kayit">
	  
	  	<form method="post">
		  <div class="form-row">
			<div class="col">
			  <label for="AracAdi">Araba Markası</label>
			  <input type="text" class="form-control" placeholder="Araba Adı" id="AracAdi" name="araba_marka" value="">
			</div>
			  
			<div class="col">
			  <label for="ModelAdi">Araba Modeli</label>
			  <input type="text" class="form-control" placeholder="Araba Modeli" id="ArabaModeli" name="araba_model" value="">
			</div>
			  
			<div class="col">
			  <label for="plaka">Plaka</label>
			  <input type="text" class="form-control" placeholder="Plaka" id="Plaka" name="plaka" value="">
			</div>
			  
			<div class="col">
			  <label for="Email">Kilometre</label>
			  <input type="text" class="form-control" placeholder="Kilometre" id="kilometre" name="kilometre" value="">
			</div>
			  
			<div class="col">
			  <label for="Yakit">Yakit</label>
			  <input type="text" class="form-control" placeholder="Yakit" id="yakit" name="yakit" value="">
			</div>
			  
			<div class="col">
			  <label for="vin">Araba Şasi No</label>
			  <input type="text" class="form-control" placeholder="Araba Şasi No" id="vin" name="vin" value="">
			</div>
			  
		  </div>
			  
			 <div class="col mt-4">
				 <button type="submit" name="ekle" class="btn btn-success float-right">Ekle</button>
			 </div>
		</div>
		</form>
	  
	  <!-- ARABA TABLO KISMI -->
	  <div class="row-md-12 d-flex justify-content-center p-3 m-2">
		  <form method="get" action="">
		  <table class="table">
			  <thead class="thead-dark">
				<tr>
				  <th scope="col">Araba Şasi No</th>
				  <th scope="col">Araba Markası</th>
				  <th scope="col">Araba Modeli</th>
				  <th scope="col">Plaka</th>
				  <th scope="col">Araba Kilometre</th>
				  <th scope="col">Yakıt Miktarı</th>
					<th scope="col">işlem</th>
				</tr>
			  </thead>
			  <tbody>
				<?php while($sonuc=mysqli_fetch_assoc($kayit_araba)) {?>
				  
				<tr>
				  <th scope="row"><?php echo $sonuc["arac_vin"]; ?></th>
				  <td><?php echo $sonuc["arac_adi"]; ?></td>
				  <td><?php echo $sonuc["model_adi"]; ?></td>
				  <td><?php echo $sonuc["plaka"]; ?></td>
				  <td><?php echo $sonuc["kilometre"]." Kilometre"; ?></td>
				  <td><?php echo $sonuc["yakit"]." Litre"; ?></td>
				  
				  <td><a href="?sil=<?=$sonuc['arac_vin']?>" type="submit" class="btn btn-danger" name="sil">Sil</a></td>
				</tr>
				<?php } ?>
			  </tbody>
			</table>
		</form>
	  </div>

  </div>
</div>
	  
	  
	  
	  
	  

	  
	  
	  


	  
	  
	  
	  
	  
	  
	  
	  
	  
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>