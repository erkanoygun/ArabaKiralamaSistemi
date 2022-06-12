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

<!-- ARABALARI ÇEKME -->
<?php

	$bul_araba = "SELECT * FROM arabalar ORDER BY arac_vin DESC";

	$kayit_araba = $baglanti->query($bul_araba);

?>


<!-- MUSTERİ GÜNCELLEME -->
<?php
	$gelenid = $_GET["id"];
	if(isset($_POST["guncelle"]))
	{
		
		if(isset($_POST["option1"])){
			$sql = "UPDATE musteriler SET adi='".$_POST["user_name"]."',soyadi='".$_POST["last_name"]."',tc_no='".$_POST["identitiy_no"]."',e_mail='".$_POST["e_mail"]."',tel_no='".$_POST["phone_no"]."',kiralanan_model='".$_POST["marka_model"]."' WHERE id=".$gelenid;
			
			$sonuc = mysqli_query($baglanti,$sql);
		}else{
			$sql = "UPDATE musteriler SET adi='".$_POST["user_name"]."',soyadi='".$_POST["last_name"]."',tc_no='".$_POST["identitiy_no"]."',e_mail='".$_POST["e_mail"]."',tel_no='".$_POST["phone_no"]."' WHERE id=".$gelenid;
			
			$sonuc = mysqli_query($baglanti,$sql);
	}
		
		
		
		if($sonuc)
		{
			//echo " veri güncellendi";
			header("Location:index.php");
		}else{
			echo " veri güncellenmedi!!";
			//header("Location:index.php");
		}
		
		
		
		
	}
	
?>


<!-- MUSTERİ KAYITLARINI ÇEKME -->
<?php
	$gelenid = $_GET["id"];
	$bul = "SELECT * FROM musteriler WHERE id = ".$gelenid;

	$kayit = $baglanti->query($bul);

	$sonuc=mysqli_fetch_assoc($kayit)

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
  <div class="col-md-12 justify-content-center">
	  <a href="index.php" style="text-decoration: none;"><button type="button" class="btn btn-success mt-3 btn-block">Ana Sayfa Git</button></a>

  <!-- MUSTERİ GÜNCELLEME KISMI -->
  <div class="row-md-12 d-flex justify-content-center p-3 m-2" id="musteri_kayit">
	  
	  	<form method="post">
		  <div class="form-row">
			<div class="col">
			  <label for="UserName">Adı</label>
			  <input type="text" class="form-control" placeholder="UserName" id="UserName" name="user_name" value="<?php echo $sonuc["adi"]; ?>">
			</div>
			  
			<div class="col">
			  <label for="LastName">Soyadı</label>
			  <input type="text" class="form-control" placeholder="LastName" id="LastName" name="last_name" value="<?php echo $sonuc["soyadi"]; ?>">
			</div>
			  
			<div class="col">
			  <label for="IdentityNo">Tc No</label>
			  <input type="text" class="form-control" placeholder="IdentityNo" id="IdentityNo" name="identitiy_no" value="<?php echo $sonuc["tc_no"]; ?>">
			</div>
			  
			<div class="col">
			  <label for="Email">E-Mail</label>
			  <input type="text" class="form-control" placeholder="Email" id="Email" name="e_mail" value="<?php echo $sonuc["e_mail"]; ?>">
			</div>
			  
			<div class="col">
			  <label for="PhoneNo">Telefon No</label>
			  <input type="text" class="form-control" placeholder="PhoneNo" id="PhoneNo" name="phone_no" value="<?php echo $sonuc["tel_no"]; ?>">
			</div>
			  
		  </div>
			
		  
		  <div class="form-row mt-2">
			<div class="col">
				<label for="exampleFormControlSelect1">Güncellenecek Model</label>
				<select class="form-control" id="exampleFormControlSelect1" name="marka_model">
				  <?php while($sonucaraba=mysqli_fetch_assoc($kayit_araba)) { ?>
					  <option><?php echo $sonucaraba['arac_adi']."  ".$sonucaraba['model_adi']; ?></option>
				  <?php } ?>
				</select>
		  </div>
			  
			<div class="form-col">
			   <div class="form-check mt-4 ml-3">
				  <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" >
				  <label class="form-check-label">Aracı Güncelle</label>
				</div>
				<h5 class="ml-3">Kiralanan Araç: <?php echo $sonuc["kiralanan_model"]; ?></h5>
			</div>
			  
			 <div class="col mt-4">
				 <button type="submit" name="guncelle" class="btn btn-success float-right">Güncelle</button>
			 </div>
		</div>
		</form>
  </div>
	  

  </div>
</div>
	  
	  
	  
	  
	  

	  
	  
	  


	  
	  
	  
	  
	  
	  
	  
	  
	  
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>